{{-- 📁 resources/views/components/filters-form.blade.php --}}

<form method="GET" action="{{ route('organizer') }}" class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        
        {{-- Botão Filtros (recolhível) --}}
        <div class="mb-3 mb-md-0">
            <button type="button" 
                    class="btn btn-sm text-white fw-semibold px-3 rounded-pill" 
                    style="background-color: #F29D35;"
                    onclick="toggleFiltros()"
                    id="btnFiltros">
                Filtros
                <i class="bi bi-chevron-down ms-1" id="iconFiltros"></i>
            </button>
        </div>

        {{-- Campo de Pesquisa --}}
        <div class="input-group w-auto">
            <input type="text" 
                   name="q"
                   class="form-control rounded-start-pill border-0 shadow-sm"
                   placeholder="Pesquisar..." 
                   value="{{ request('q') }}">
            <button type="submit" class="btn rounded-end-pill text-white" style="background-color: #F29D35;">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>

    {{-- Painel de Filtros Recolhível --}}
    <div class="collapse" id="filtrosCollapse">
        <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 2px solid #f8a43d;">
            <div class="card-body p-4">
                <div class="row g-3">
                    
                    {{-- Status --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Todos</option>
                            @foreach(\App\Enums\OrganizerStatus::cases() as $case)
                                <option value="{{ $case->value }}" 
                                        {{ request('status') == $case->value ? 'selected' : '' }}>
                                    {{ \App\Enums\OrganizerStatus::labels()[$case->value] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Cliente --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Cliente</label>
                        <input type="text" 
                               name="cliente" 
                               class="form-control" 
                               placeholder="Nome do cliente"
                               value="{{ request('cliente') }}">
                    </div>

                    {{-- Plataforma --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Plataforma</label>
                        <select name="plataforma" class="form-select">
                            <option value="">Todas</option>
                            <option value="instagram" {{ request('plataforma') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="facebook" {{ request('plataforma') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="tiktok" {{ request('plataforma') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                            <option value="linkedin" {{ request('plataforma') == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="twitter" {{ request('plataforma') == 'twitter' ? 'selected' : '' }}>Twitter/X</option>
                            <option value="youtube" {{ request('plataforma') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="pinterest" {{ request('plataforma') == 'pinterest' ? 'selected' : '' }}>Pinterest</option>
                            <option value="outras" {{ request('plataforma') == 'outras' ? 'selected' : '' }}>Outras</option>
                        </select>
                    </div>

                    {{-- Tipo de Conteúdo --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Tipo de Conteúdo</label>
                        <select name="tipo_conteudo" class="form-select">
                            <option value="">Todos</option>
                            <option value="reels" {{ request('tipo_conteudo') == 'reels' ? 'selected' : '' }}>Reels</option>
                            <option value="carrossel" {{ request('tipo_conteudo') == 'carrossel' ? 'selected' : '' }}>Carrossel</option>
                            <option value="post_unico" {{ request('tipo_conteudo') == 'post_unico' ? 'selected' : '' }}>Post Único</option>
                            <option value="stories" {{ request('tipo_conteudo') == 'stories' ? 'selected' : '' }}>Stories</option>
                            <option value="video" {{ request('tipo_conteudo') == 'video' ? 'selected' : '' }}>Vídeo</option>
                            <option value="artigo" {{ request('tipo_conteudo') == 'artigo' ? 'selected' : '' }}>Artigo</option>
                            <option value="thread" {{ request('tipo_conteudo') == 'thread' ? 'selected' : '' }}>Thread</option>
                        </select>
                    </div>

                    {{-- Prazo - Data Inicial --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Prazo de</label>
                        <input type="date" 
                               name="from" 
                               class="form-control"
                               value="{{ request('from') }}">
                    </div>

                    {{-- Prazo - Data Final --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Prazo até</label>
                        <input type="date" 
                               name="to" 
                               class="form-control"
                               value="{{ request('to') }}">
                    </div>

                    {{-- Botões --}}
                    <div class="col-md-6 d-flex align-items-end gap-2">
                        <button type="submit" class="btn text-white rounded-pill px-4" style="background-color: #F29D35;">
                            <i class="bi bi-check-circle me-1"></i> Aplicar Filtros
                        </button>
                        
                        @if(request()->hasAny(['q', 'status', 'plataforma', 'tipo_conteudo', 'cliente', 'from', 'to']))
                            <a href="{{ route('organizer') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-x-circle me-1"></i> Limpar
                            </a>
                        @endif
                    </div>

                </div>

                {{-- Contador de resultados --}}
                @if(isset($ideas))
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Mostrando <strong>{{ $ideas->total() }}</strong> resultado(s)
                        </small>
                    </div>
                @endif

            </div>
        </div>
    </div>
</form>

{{-- Script simplificado com onclick --}}
<script>
function toggleFiltros() {
    const collapse = document.getElementById('filtrosCollapse');
    const icon = document.getElementById('iconFiltros');
    
    // Verifica se está aberto ou fechado
    if (collapse.classList.contains('show')) {
        // Está aberto, então fecha
        collapse.classList.remove('show');
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    } else {
        // Está fechado, então abre
        collapse.classList.add('show');
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    }
}
</script>