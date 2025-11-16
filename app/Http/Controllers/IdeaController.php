<?php

namespace App\Http\Controllers;

use App\Enums\OrganizerStatus;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index(Request $request)
    {
        $q      = $request->string('q')->toString();
        $status = $request->string('status')->toString();
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
            ->when($from, fn($qb) => $qb->whereDate('prazo', '>=', $from))
            ->when($to, fn($qb) => $qb->whereDate('prazo', '<=', $to))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('ideas.index', [
            'items'   => $items,
            'labels'  => OrganizerStatus::labels(),
            'status'  => $status,
            'query'   => $q,
        ]);
    }

    public function create()
    {
    return view('ideas.create');
    }

    public function store(StoreIdeaRequest $request)
    {
        Idea::create($request->validated() + ['user_id' => auth()->id()]);
        return back()->with('success', 'Card criado com sucesso!');
    }

    public function edit(Idea $idea)
    {
        $this->authorize('view', $idea);

        return view('ideas.edit', [
            'item'   => $idea,
            'labels' => OrganizerStatus::labels(),
        ]);
    }

    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        $this->authorize('update', $idea);
        $idea->update($request->validated());
        return redirect()->route('ideas.index')->with('success', 'Card atualizado!');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);
        $idea->delete();
        return back()->with('success', 'Card removido.');
    }
}

