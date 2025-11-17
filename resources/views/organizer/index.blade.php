<x-app-layout>

    {{-- SEÇÃO SUPERIOR: Saudação + Robô --}}
    <section class="text-white py-5" style="background-color: #ffa550; min-height: 50vh; display: flex; align-items: center;">
        <div class="container d-flex flex-column flex-md-row justify-content-center align-items-center text-center text-md-start gap-5">
            <div>
                <h1 class="fw-bold display-6 text-dark mb-3">Olá, {{ $user->name }}!</h1>
                <h3 class="fw-semibold text-dark mb-4">O que vamos criar hoje?</h3>

                <a href="{{ route('ideas.create') }}"
                   class="btn btn-light px-4 py-2 fw-semibold rounded-pill shadow-sm"
                   style="color: #000000ff;">
                    + Criar nova ideia
                </a>
            </div>

            <div class="text-center">
                <img src="{{ asset('/imagens/robot.png') }}" alt="Robô assistente" class="img-fluid" style="max-height: 250px;">
            </div>
        </div>
    </section>

    {{-- FILTROS E PESQUISA --}}
    <div class="container mt-5" style="padding-bottom: 80px;">
        
        {{-- Componente de Filtros --}}
        <x-filters-form :ideas="$ideas" />

        {{-- CARDS --}}
        @if ($ideas->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-lightbulb display-1 text-muted mb-3"></i>
                <p class="text-muted fs-5 mb-4">
                    @if(request()->hasAny(['q', 'status', 'plataforma', 'tipo_conteudo', 'cliente', 'from', 'to']))
                        Nenhuma ideia encontrada com os filtros aplicados.
                    @else
                        Você ainda não criou nenhuma ideia.
                    @endif
                </p>
            </div>
        @else
            <div class="row g-4 justify-content-center">
                @foreach ($ideas as $idea)
                    <div class="col-12 col-md-6 col-lg-4">
                        <x-idea-card :idea="$idea" />
                    </div>
                @endforeach
            </div>

            {{-- PAGINAÇÃO CUSTOMIZADA --}}
            @if ($ideas->hasPages())
                <nav aria-label="Navegação de páginas" class="mt-5">
                    <ul class="pagination justify-content-center">
                        {{-- Botão Anterior --}}
                        @if ($ideas->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $ideas->appends(request()->query())->previousPageUrl() }}">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Números das páginas --}}
                        @for ($i = 1; $i <= $ideas->lastPage(); $i++)
                            @if ($i == $ideas->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $i }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $ideas->appends(request()->query())->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        {{-- Botão Próximo --}}
                        @if ($ideas->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $ideas->appends(request()->query())->nextPageUrl() }}">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        @endif
    </div>

    {{-- CSS da paginação --}}
    <style>
        .pagination {
            gap: 0.5rem;
        }
        
        .pagination .page-link {
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            color: #f29d35;
            border: 2px solid #dee2e6;
            background-color: white;
            transition: all 0.2s;
            min-width: 40px;
            text-align: center;
            text-decoration: none;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #f29d35;
            border-color: #f29d35;
            color: white;
        }
        
        .pagination .page-link:hover {
            background-color: #ffa550;
            border-color: #ffa550;
            color: white;
        }
        
        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
    </style>

</x-app-layout>