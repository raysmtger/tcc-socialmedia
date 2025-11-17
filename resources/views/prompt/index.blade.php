<x-app-layout>
    <div class="container py-4">
        
        {{-- Estatísticas (SEM favoritos) --}}
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm rounded-3" style="border: 2px solid #f8a43d !important;">
                    <div class="card-body text-center py-3">
                        <h3 class="mb-0 fw-bold" style="color: #f29d35;">{{ $stats['total'] }}</h3>
                        <small class="text-muted">Gerações Totais</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm rounded-3" style="border: 2px solid #f8a43d !important;">
                    <div class="card-body text-center py-3">
                        <h3 class="mb-0 fw-bold" style="color: #f29d35;">{{ $stats['este_mes'] }}</h3>
                        <small class="text-muted">Este Mês</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ferramentas Disponíveis --}}
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="h5 fw-bold" style="color: #f29d35;">
                    <i class="bi bi-tools"></i> Ferramentas Disponíveis
                </h3>
            </div>
        </div>

        <div class="row mb-4">
            
            {{-- Gerador de Legendas --}}
            <div class="col-md-4 mb-3">
                <a href="{{ route('prompt.create.caption') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm hover-card border-0 rounded-3" style="border: 2px solid #f8a43d !important;">
                        <div class="card-body text-center p-3">
                            <div class="mb-2">
                                <i class="bi bi-pencil-square display-4" style="color: #f29d35;"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1rem;">Legendas</h5>
                            <p class="card-text text-muted small mb-2" style="font-size: 0.85rem;">
                                Gere legendas criativas para seus posts com o tom de voz ideal
                            </p>
                            <span class="btn btn-sm text-white rounded-pill px-3" style="background-color: #f29d35; font-size: 0.85rem;">
                                Criar Legenda
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Paleta de Cores --}}
            <div class="col-md-4 mb-3">
                <a href="{{ route('prompt.create.palette') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm hover-card border-0 rounded-3" style="border: 2px solid #f8a43d !important;">
                        <div class="card-body text-center p-3">
                            <div class="mb-2">
                                <i class="bi bi-palette-fill display-4" style="color: #f29d35;"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1rem;">Paleta de Cores</h5>
                            <p class="card-text text-muted small mb-2" style="font-size: 0.85rem;">
                                Crie paletas harmônicas baseadas no sentimento da sua campanha
                            </p>
                            <span class="btn btn-sm text-white rounded-pill px-3" style="background-color: #f29d35; font-size: 0.85rem;">
                                Criar Paleta
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Ideias de Conteúdo --}}
            <div class="col-md-4 mb-3">
                <a href="{{ route('prompt.create.ideas') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm hover-card border-0 rounded-3" style="border: 2px solid #f8a43d !important;">
                        <div class="card-body text-center p-3">
                            <div class="mb-2">
                                <i class="bi bi-lightbulb-fill display-4" style="color: #f29d35;"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1rem;">Ideias de Conteúdo</h5>
                            <p class="card-text text-muted small mb-2" style="font-size: 0.85rem;">
                                Receba sugestões de posts para datas comemorativas e campanhas
                            </p>
                            <span class="btn btn-sm text-white rounded-pill px-3" style="background-color: #f29d35; font-size: 0.85rem;">
                                Gerar Ideias
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Hashtags --}}
            <div class="col-md-4 mb-3">
                <a href="{{ route('prompt.create.hashtags') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm hover-card border-0 rounded-3" style="border: 2px solid #f8a43d !important;">
                        <div class="card-body text-center p-3">
                            <div class="mb-2">
                                <i class="bi bi-hash display-4" style="color: #f29d35;"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1rem;">Hashtags</h5>
                            <p class="card-text text-muted small mb-2" style="font-size: 0.85rem;">
                                Descubra hashtags relevantes para aumentar seu alcance
                            </p>
                            <span class="btn btn-sm text-white rounded-pill px-3" style="background-color: #f29d35; font-size: 0.85rem;">
                                Gerar Hashtags
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Call-to-Action --}}
            <div class="col-md-4 mb-3">
                <a href="{{ route('prompt.create.cta') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm hover-card border-0 rounded-3" style="border: 2px solid #f8a43d !important;">
                        <div class="card-body text-center p-3">
                            <div class="mb-2">
                                <i class="bi bi-cursor-fill display-4" style="color: #f29d35;"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1rem;">Call-to-Action</h5>
                            <p class="card-text text-muted small mb-2" style="font-size: 0.85rem;">
                                Crie CTAs impactantes que convertem visitantes em clientes
                            </p>
                            <span class="btn btn-sm text-white rounded-pill px-3" style="background-color: #f29d35; font-size: 0.85rem;">
                                Criar CTA
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Histórico --}}
            <div class="col-md-4 mb-3">
                <a href="{{ route('prompt.history') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm hover-card border-0 rounded-3" style="border: 2px solid #dee2e6 !important; background-color: #f8f9fa;">
                        <div class="card-body text-center p-3">
                            <div class="mb-2">
                                <i class="bi bi-clock-history display-4 text-secondary"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2" style="font-size: 1rem;">Histórico</h5>
                            <p class="card-text text-muted small mb-2" style="font-size: 0.85rem;">
                                Acesse todas as suas gerações anteriores
                            </p>
                            <span class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="font-size: 0.85rem;">
                                Ver Histórico
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- SEÇÃO DE FAVORITOS --}}
        @if($favoritePrompts->count() > 0)
        <div class="row mb-3 mt-5">
            <div class="col-12">
                <h3 class="h5 fw-bold" style="color: #f29d35;">
                    <i class="bi bi-star-fill"></i> Favoritos
                </h3>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3 mb-4" style="border: 2px solid #f8a43d !important;">
            <div class="list-group list-group-flush">
                @foreach($favoritePrompts as $prompt)
                <a href="{{ route('prompt.show', $prompt->id) }}" 
                   class="list-group-item list-group-item-action border-0 py-3">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <div>
                            <span class="me-2" style="color: #f29d35; font-size: 1.3rem;">
                                {{ \App\Models\Prompt::getTypeIcons()[$prompt->type] }}
                            </span>
                            <strong class="text-dark">{{ \App\Models\Prompt::getTypeLabels()[$prompt->type] }}</strong>
                            <br>
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $prompt->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <div>
                            <span class="badge rounded-pill px-3 py-2" style="background-color: #f29d35;">
                                <i class="bi bi-star-fill"></i> Favorito
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Gerações Recentes --}}
        @if($recentPrompts->count() > 0)
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="h5 fw-bold" style="color: #f29d35;">
                    <i class="bi bi-clock"></i> Gerações Recentes
                </h3>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3" style="border: 2px solid #f8a43d !important;">
            <div class="list-group list-group-flush">
                @foreach($recentPrompts as $prompt)
                <a href="{{ route('prompt.show', $prompt->id) }}" 
                   class="list-group-item list-group-item-action border-0 py-3">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <div>
                            <span class="me-2" style="color: #f29d35; font-size: 1.3rem;">
                                  {!! \App\Models\Prompt::getTypeIcons()[$prompt->type] !!}
                            </span>
                            <strong class="text-dark">{{ \App\Models\Prompt::getTypeLabels()[$prompt->type] }}</strong>
                            <br>
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $prompt->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <div>
                            @if($prompt->favorited)
                                <span class="badge rounded-pill px-3 py-2" style="background-color: #f29d35;">
                                    <i class="bi bi-star-fill"></i> Favorito
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</x-app-layout>

<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(248, 164, 61, 0.15) !important;
    }
</style>