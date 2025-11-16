<x-app-layout>

    {{-- SEÇÃO SUPERIOR: Saudação + Robô --}}
    <section class="text-white py-5" style="background-color: #F29D35;">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="text-center text-md-start mb-4 mb-md-0">
                <h1 class="fw-bold display-6 text-dark mb-3">Olá, {{ $user->name }} 👋</h1>
                <h3 class="fw-semibold text-dark mb-4">O que vamos criar hoje?</h3>

                <a href="{{ route('ideas.create') }}"
                   class="btn btn-light px-4 py-2 fw-semibold rounded-pill shadow-sm"
                   style="color: #F29D35;">
                    + Criar nova ideia
                </a>
            </div>

            <div class="text-center">
                <img src="{{ asset('assets/images/robo.png') }}" alt="Robô assistente" class="img-fluid" style="max-height: 200px;">
            </div>
        </div>
    </section>

    {{-- FILTROS E PESQUISA --}}
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <div class="mb-3 mb-md-0">
                <button class="btn btn-sm text-white fw-semibold px-3 rounded-pill" style="background-color: #F29D35;">Filtros</button>
            </div>

            <div class="input-group w-auto">
                <input type="text" class="form-control rounded-start-pill border-0 shadow-sm"
                       placeholder="Pesquisar..." aria-label="Pesquisar">
                <button class="btn rounded-end-pill text-white" style="background-color: #F29D35;">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        {{-- CARDS --}}
        @if($ideas->isEmpty())
            <p class="text-center text-muted fs-5">🌱 Você ainda não criou nenhuma ideia.</p>
        @else
            <div class="row g-4">
                @foreach ($ideas as $idea)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 rounded-4 overflow-hidden"
                             style="background-color: #fff;">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark">{{ $idea->titulo }}</h5>
                                <p class="text-muted small mb-1">{{ $idea->prazo?->format('d M, Y') ?? '—' }}</p>

                                <p class="text-dark mt-3">{{ $idea->descricao ?? 'Sem descrição.' }}</p>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    @php
                                        $status = strtolower($idea->status->name ?? $idea->status);
                                    @endphp

                                    @if($status === 'em andamento')
                                        <span class="badge rounded-pill px-3 py-2" style="background-color: #FFD54F; color: #000;">Em andamento</span>
                                    @elseif($status === 'concluído' || $status === 'concluido')
                                        <span class="badge rounded-pill px-3 py-2" style="background-color: #8BC34A;">Concluído</span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2" style="background-color: #FFB74D;">Ideias</span>
                                    @endif

                                    <i class="bi bi-pencil-square text-secondary fs-5"></i>
                                </div>
                            </div>

                            {{-- FAIXA INFERIOR COLORIDA --}}
                            <div style="background-color: #F29D35; height: 10px;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</x-app-layout>
