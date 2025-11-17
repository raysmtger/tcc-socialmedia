<x-app-layout>
<div class="container py-5">
    
    {{-- Breadcrumb com botão voltar --}}
<nav aria-label="breadcrumb" class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('prompt.index') }}" style="color: #f29d35;">Assistente IA</a>
            </li>
            <li class="breadcrumb-item active" style="color: #6c757d;">Resultado</li>
        </ol>
        
        {{-- BOTÃO VOLTAR --}}
        <a href="{{ route('prompt.index') }}" class="btn btn-light rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
    </div>
</nav>

    {{-- Mensagens --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            
            {{-- Card do Resultado --}}
            <div class="card shadow-sm border-0 rounded-4 mb-4" style="border: 3px solid #f8a43d !important;">
                <div class="card-header d-flex justify-content-between align-items-center text-white" 
                     style="background-color: #f29d35; border-radius: 20px 20px 0 0 !important;">
                    <div>
                        <span class="fs-4 me-2">{!! \App\Models\Prompt::getTypeIcons()[$prompt->type] !!}</span>
                            <strong>{{ \App\Models\Prompt::getTypeLabels()[$prompt->type] }}</strong>
                    </div>
                    <small class="opacity-75">
                        <i class="bi bi-calendar me-1"></i>
                        {{ $prompt->created_at->format('d/m/Y H:i') }}
                    </small>
                </div>

                <div class="card-body p-4">
                    
                    {{-- Resultado para PALETA DE CORES --}}
                    @if($prompt->type === 'paleta')
                        @php
                            try {
                                $palette = json_decode($prompt->result, true);
                            } catch (\Exception $e) {
                                $palette = null;
                            }
                        @endphp

                        @if($palette && isset($palette['cores']))
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3" style="color: #f29d35;">
                                    <i class="bi bi-palette-fill me-2"></i>Paleta de Cores:
                                </h5>
                                <div class="d-flex gap-3 mb-4 flex-wrap justify-content-center">
                                    @foreach($palette['cores'] as $index => $cor)
                                        <div class="text-center">
                                            <div 
                                                style="width: 100px; height: 100px; background-color: {{ $cor }}; border-radius: 15px; border: 3px solid #dee2e6; box-shadow: 0 4px 6px rgba(0,0,0,0.1);"
                                                title="{{ $palette['nomes'][$index] ?? $cor }}"
                                            ></div>
                                            <small class="d-block mt-2 fw-bold text-dark">{{ $cor }}</small>
                                            <small class="text-muted">{{ $palette['nomes'][$index] ?? '' }}</small>
                                        </div>
                                    @endforeach
                                </div>
                                
                                @if(isset($palette['justificativa']))
                                    <div class="alert alert-light border-2 rounded-3" style="border-color: #f8a43d !important; background-color: #fff8f0;">
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-info-circle-fill me-2 fs-5" style="color: #f29d35;"></i>
                                            <div>
                                                <strong style="color: #f29d35;">Justificativa:</strong>
                                                <p class="mb-0 mt-2 text-dark">{{ $palette['justificativa'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="result-content">
                                {!! nl2br(e($prompt->result)) !!}
                            </div>
                        @endif
                    @else
                        {{-- Resultado para OUTROS TIPOS (texto) --}}
                        <div class="result-content">
                            {!! nl2br(e($prompt->result)) !!}
                        </div>
                    @endif

                    {{-- Botões de Ação --}}
                    <div class="d-flex gap-2 mt-4 pt-4 flex-wrap" style="border-top: 2px solid #f8a43d;">
                        <button class="btn btn-success rounded-pill px-4" onclick="copyToClipboard()">
                            <i class="bi bi-clipboard-check me-1"></i> Copiar
                        </button>
                        
                        <form action="{{ route('prompt.favorite', $prompt->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn rounded-pill px-4 {{ $prompt->favorited ? 'text-white' : 'btn-outline-warning' }}"
                                    style="{{ $prompt->favorited ? 'background-color: #f29d35;' : '' }}">
                                <i class="bi bi-star-fill me-1"></i>
                                {{ $prompt->favorited ? 'Favoritado' : 'Favoritar' }}
                            </button>
                        </form>

                        <a href="{{ route('prompt.index') }}" class="btn rounded-pill px-4" 
                           style="background-color: #f8a43d; color: white;">
                            <i class="bi bi-arrow-repeat me-1"></i> Nova Geração
                        </a>

                        <form action="{{ route('prompt.destroy', $prompt->id) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                                <i class="bi bi-trash me-1"></i> Excluir
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

        {{-- Sidebar com Informações --}}
        <div class="col-lg-4">
            
            {{-- Parâmetros Usados --}}
            <div class="card shadow-sm border-0 rounded-4 mb-3" style="border: 3px solid #f8a43d !important;">
                <div class="card-header text-white" style="background-color: #f29d35;">
                    <strong>
                        <i class="bi bi-sliders me-1"></i> Parâmetros Usados
                    </strong>
                </div>
                <div class="card-body">
                    @foreach($prompt->input_data as $key => $value)
                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #dee2e6;">
                            <strong class="text-capitalize d-block mb-1" style="color: #f29d35;">
                                {{ str_replace('_', ' ', $key) }}:
                            </strong>
                            <p class="mb-0 text-muted">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Dicas --}}
            <div class="alert alert-light border-2 rounded-3" style="border-color: #f8a43d !important; background-color: #fff8f0;">
                <div class="d-flex align-items-start">
                    <i class="bi bi-lightbulb-fill me-2 fs-4" style="color: #f29d35;"></i>
                    <div>
                        <strong style="color: #f29d35;">Dica:</strong>
                        <p class="mb-0 mt-2 text-dark">
                            @switch($prompt->type)
                                @case('legenda')
                                    Você pode editar a legenda gerada para personalizar ainda mais!
                                    @break
                                @case('paleta')
                                    Use ferramentas como Canva ou Figma para aplicar essas cores.
                                    @break
                                @case('hashtags')
                                    Misture hashtags populares com nichadas para melhor alcance.
                                    @break
                                @case('ideias')
                                    Salve as ideias que mais gostou nos favoritos!
                                    @break
                                @case('cta')
                                    Teste diferentes CTAs para ver qual converte melhor.
                                    @break
                            @endswitch
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

{{-- Área invisível para copiar --}}
<textarea id="copyArea" style="position: absolute; left: -9999px;">{{ $prompt->result }}</textarea>

<script>
    function copyToClipboard() {
        const copyArea = document.getElementById('copyArea');
        copyArea.select();
        document.execCommand('copy');
        
        // Feedback visual
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Copiado!';
        btn.classList.remove('btn-success');
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalHTML;
        }, 2000);
    }
</script>

<style>
    .result-content {
        font-size: 1rem;
        line-height: 1.8;
        white-space: pre-wrap;
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-radius: 12px;
        border-left: 4px solid #f29d35;
        color: #333;
    }
</style>
</x-app-layout>