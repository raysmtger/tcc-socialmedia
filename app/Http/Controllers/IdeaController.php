<?php

namespace App\Http\Controllers;

use App\Enums\OrganizerStatus;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class IdeaController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource with filters.
     */
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $status = $request->string('status')->toString();
        $plataforma     = $request->string('plataforma')->toString();
        $tipo_conteudo  = $request->string('tipo_conteudo')->toString();
        $cliente    = $request->string('cliente')->toString();
        $from   = $request->date('from');
        $to     = $request->date('to');
        

        $items = Idea::mine()
            ->when($q, fn($qb) =>
                $qb->where(fn($w) =>
                    $w->where('titulo', 'like', "%$q%")
                      ->orWhere('descricao', 'like', "%$q%")
                      ->orWhere('nome_cliente', 'like', "%$q%")
                )
            )
            ->when($status, fn($qb) => $qb->where('status', $status))
            ->when($plataforma, fn($qb) => $qb->where('plataforma', $plataforma))
            ->when($tipo_conteudo, fn($qb) => $qb->where('tipo_conteudo', $tipo_conteudo))
            ->when($cliente, fn($qb) => $qb->where('nome_cliente', 'like', "%$cliente%"))
            ->when($from, fn($qb) => $qb->whereDate('prazo', '>=', $from))
            ->when($to, fn($qb) => $qb->whereDate('prazo', '<=', $to))
            ->latest('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('ideas.index', [
            'ideas'    => $items, //mudei pro plural, caso
            'labels'  => OrganizerStatus::labels(),
            'status'  => $status,
            'query'   => $q,
            'plataforma'    => $plataforma,
            'tipo_conteudo' => $tipo_conteudo,
            'cliente'       => $cliente,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request)
{
    $data = $request->validated() + ['user_id' => auth()->id()];

    // Imagens
    if ($request->hasFile('imagens_descricao')) {
        $imagensPaths = [];
        foreach ($request->file('imagens_descricao') as $file) {
            $path = $file->store('ideas/imagens', 'public');
            $imagensPaths[] = $path;
        }
        $data['imagens_descricao'] = json_encode($imagensPaths);
    }

    // Criar ideia
    Idea::create($data);

    return redirect()->route('organizer')
        ->with('success', 'Card criado com sucesso!');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        $this->authorize('view', $idea);

        return view('ideas.edit', [
            'idea'   => $idea,
            'labels' => OrganizerStatus::labels(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea)
{
    $this->authorize('update', $idea);
    $data = $request->validated();

    // Atualizar imagens
    if ($request->hasFile('imagens_descricao')) {
        $imagensPaths = $idea->imagens_descricao ? json_decode($idea->imagens_descricao, true) : [];
        foreach ($request->file('imagens_descricao') as $file) {
            $path = $file->store('ideas/imagens', 'public');
            $imagensPaths[] = $path;
        }
        $data['imagens_descricao'] = json_encode($imagensPaths);
    }

    $idea->update($data);

    return redirect()->route('organizer')
        ->with('success', 'Card atualizado com sucesso!');
}

 /**
 * Remove uma imagem específica da ideia.
 */
public function removeImage(Request $request, Idea $idea)
{
    $this->authorize('update', $idea);
    
    $imagePath = $request->input('image');
    
    // Decodificar JSON se necessário
    $imagens = $idea->imagens_descricao;
    
    // Se for string JSON, decodificar
    if (is_string($imagens)) {
        $imagens = json_decode($imagens, true) ?? [];
    }
    
    // Se não for array, inicializar como array vazio
    if (!is_array($imagens)) {
        $imagens = [];
    }
    
    // Verificar se a imagem existe no array
    if (!in_array($imagePath, $imagens)) {
        return response()->json([
            'success' => false,
            'message' => 'Imagem não encontrada no registro.'
        ], 404);
    }
    
    // Remover a imagem do array
    $imagens = array_filter($imagens, function($img) use ($imagePath) {
        return $img !== $imagePath;
    });
    
    // Deletar arquivo físico do storage
    if (Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
    }
    
    // Reindexar o array e salvar como JSON
    $idea->imagens_descricao = json_encode(array_values($imagens));
    $idea->save();
    
    return response()->json([
        'success' => true,
        'message' => 'Imagem removida com sucesso!'
    ]);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);
        if ($idea->anexos) {
            $anexos = json_decode($idea->anexos, true);
            foreach ($anexos as $anexo) {
                Storage::disk('public')->delete($anexo);
            }
        }

        $idea->delete();
        
        return redirect()->route('organizer');

    }
}