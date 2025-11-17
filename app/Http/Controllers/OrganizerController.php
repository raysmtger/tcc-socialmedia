<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Idea; 
use App\Enums\OrganizerStatus; 


class OrganizerController extends Controller
{
    public function index(Request $request)
    {
        $user           = Auth::user();
        $q              = $request->string('q')->toString();
        $status         = $request->string('status')->toString();
        $plataforma     = $request->string('plataforma')->toString();
        $tipo_conteudo  = $request->string('tipo_conteudo')->toString();
        $cliente        = $request->string('cliente')->toString();
        $from           = $request->date('from');
        $to             = $request->date('to');

        $ideas = Idea::mine()
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
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('organizer.index', [
            'user'          => $user,
            'ideas'         => $ideas,
            'labels'        => OrganizerStatus::labels(),
            'status'        => $status,
            'query'         => $q,
            'plataforma'    => $plataforma,
            'tipo_conteudo' => $tipo_conteudo,
            'cliente'       => $cliente,
        ]);
    }
}