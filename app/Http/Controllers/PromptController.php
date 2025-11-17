<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromptController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    /**
     * Dashboard principal - lista de ferramentas disponíveis
     */
    public function index()
{
    $user = Auth::user();

    // Estatísticas
    $stats = [
        'total' => $user->prompts()->count(),
        'este_mes' => $user->prompts()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count(),
    ];

    // Favoritos (usando scope da model)
    $favoritePrompts = $user->prompts()
        ->favorited()
        ->latest()
        ->take(5)
        ->get();

    // Gerações recentes
    $recentPrompts = $user->prompts()
        ->latest()
        ->take(5)
        ->get();

    return view('prompt.index', compact('stats', 'favoritePrompts', 'recentPrompts'));
}

    /**
     * Mostra formulário para gerar legendas
     */
    public function createCaption()
    {
        return view('prompt.create-caption');
    }

    /**
     * Processa geração de legendas
     */
    public function storeCaption(Request $request)
    {
        $request->validate([
            'tema' => 'required|string|max:200',
            'tom' => 'required|in:profissional,descontraído,engraçado,inspirador',
            'cta' => 'required|string|max:100',
        ]);

        try {
            $result = $this->geminiService->generateCaption(
                $request->tema,
                $request->tom,
                $request->cta
            );

            $prompt = Prompt::create([
                'user_id' => Auth::id(),
                'type' => 'legenda',
                'input_data' => $request->only(['tema', 'tom', 'cta']),
                'result' => $result,
            ]);

            return redirect()->route('prompt.show', $prompt->id)
                ->with('success', 'Legendas geradas com sucesso!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao gerar legendas: ' . $e->getMessage());
        }
    }

    /**
     * Mostra formulário para gerar paleta de cores
     */
    public function createPalette()
    {
        return view('prompt.create-palette');
    }

    /**
     * Processa geração de paleta
     */
    public function storePalette(Request $request)
    {
        $request->validate([
            'campanha' => 'required|string|max:200',
            'sentimento' => 'required|string|max:100',
        ]);

        try {
            $result = $this->geminiService->generateColorPalette(
                $request->campanha,
                $request->sentimento
            );

            $prompt = Prompt::create([
                'user_id' => Auth::id(),
                'type' => 'paleta',
                'input_data' => $request->only(['campanha', 'sentimento']),
                'result' => $result,
            ]);

            return redirect()->route('prompt.show', $prompt->id)
                ->with('success', 'Paleta de cores gerada com sucesso!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao gerar paleta: ' . $e->getMessage());
        }
    }

    /**
     * Mostra formulário para gerar ideias
     */
    public function createIdeas()
    {
        return view('prompt.create-ideas');
    }

    /**
     * Processa geração de ideias
     */
    public function storeIdeas(Request $request)
    {
        $request->validate([
            'nicho' => 'required|string|max:100',
            'data_comemorativa' => 'required|string|max:100',
            'objetivo' => 'required|string|max:200',
        ]);

        try {
            $result = $this->geminiService->generateIdeas(
                $request->nicho,
                $request->data_comemorativa,
                $request->objetivo
            );

            $prompt = Prompt::create([
                'user_id' => Auth::id(),
                'type' => 'ideias',
                'input_data' => $request->only(['nicho', 'data_comemorativa', 'objetivo']),
                'result' => $result,
            ]);

            return redirect()->route('prompt.show', $prompt->id)
                ->with('success', 'Ideias geradas com sucesso!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao gerar ideias: ' . $e->getMessage());
        }
    }

    /**
     * Mostra formulário para gerar hashtags
     */
    public function createHashtags()
    {
        return view('prompt.create-hashtags');
    }

    /**
     * Processa geração de hashtags
     */
    public function storeHashtags(Request $request)
    {
        $request->validate([
            'tema' => 'required|string|max:200',
            'plataforma' => 'required|in:Instagram,TikTok,LinkedIn,Facebook,Twitter',
            'nicho' => 'required|string|max:100',
        ]);

        try {
            $result = $this->geminiService->generateHashtags(
                $request->tema,
                $request->plataforma,
                $request->nicho
            );

            $prompt = Prompt::create([
                'user_id' => Auth::id(),
                'type' => 'hashtags',
                'input_data' => $request->only(['tema', 'plataforma', 'nicho']),
                'result' => $result,
            ]);

            return redirect()->route('prompt.show', $prompt->id)
                ->with('success', 'Hashtags geradas com sucesso!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao gerar hashtags: ' . $e->getMessage());
        }
    }

    /**
     * Mostra formulário para gerar CTA
     */
    public function createCTA()
    {
        return view('prompt.create-cta');
    }

    /**
     * Processa geração de CTA
     */
    public function storeCTA(Request $request)
    {
        $request->validate([
            'objetivo' => 'required|in:venda,engajamento,trafego,cadastro,download',
            'produto' => 'required|string|max:200',
        ]);

        try {
            $result = $this->geminiService->generateCTA(
                $request->objetivo,
                $request->produto
            );

            $prompt = Prompt::create([
                'user_id' => Auth::id(),
                'type' => 'cta',
                'input_data' => $request->only(['objetivo', 'produto']),
                'result' => $result,
            ]);

            return redirect()->route('prompt.show', $prompt->id)
                ->with('success', 'CTAs gerados com sucesso!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao gerar CTAs: ' . $e->getMessage());
        }
    }

    /**
     * Exibe resultado de uma geração específica
     */
    public function show($id)
    {
        $prompt = Prompt::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('prompt.show', compact('prompt'));
    }

    /**
     * Lista histórico de gerações
     */
    public function history()
    {
        $prompts = Prompt::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('prompt.history', compact('prompts'));
    }

    /**
     * Toggle favorito
     */
    public function toggleFavorite($id)
    {
        $prompt = Prompt::where('user_id', Auth::id())
            ->findOrFail($id);

        $prompt->update([
            'favorited' => !$prompt->favorited
        ]);

        return back()->with('success', 
            $prompt->favorited ? 'Adicionado aos favoritos!' : 'Removido dos favoritos!'
        );
    }

    /**
     * Deletar geração
     */
    public function destroy($id)
    {
        $prompt = Prompt::where('user_id', Auth::id())
            ->findOrFail($id);

        $prompt->delete();

        return back()->with('success', 'Geração excluída com sucesso!');
    }
}