<x-app-layout>
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4 mx-auto" style="max-width: 900px;">
            <div class="card-body p-4 p-md-5">
                {{-- Cabeçalho minimalista --}}
                <div class="mb-4">
                    <h3 class="fw-bold mb-1" style="color: #f29d35;">
                        <i class="bi bi-lightbulb"></i> Nova Ideia
                    </h3>
                    <p class="text-muted small mb-0">Organize seus pensamentos</p>
                </div>

                {{-- Exibição de mensagens de erro --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Atenção!</strong> Corrija os erros abaixo:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Formulário --}}
                <form action="{{ route('ideas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Título --}}
                    <div class="mb-4">
                        <input type="text" name="titulo" id="titulo"
                               class="form-control form-control-lg border-0 border-bottom rounded-0 px-0"
                               placeholder="Título da ideia..."
                               value="{{ old('titulo') }}" 
                               required
                               style="font-size: 1.5rem; font-weight: 600; border-bottom: 2px solid #f29d35 !important;">
                    </div>

                    {{-- DESCRIÇÃO --}}
                    <div class="mb-4">
                        <label for="descricao" class="form-label text-muted small">
                            <i class="bi bi-pencil-fill me-1"></i>Desenvolva sua ideia
                        </label>
                        <textarea name="descricao" id="descricao" rows="12"
                                  class="form-control border-2 rounded-3 shadow-sm"
                                  placeholder="Descreva sua ideia com todos os detalhes... 

- O que você quer criar?
- Qual o objetivo?
- Quais elementos visuais você imagina?
- Referências ou inspirações?

Dica: Quanto mais detalhes, melhor!"
                                  style="font-size: 1rem; line-height: 1.6;">{{ old('descricao') }}</textarea>
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Este é o espaço principal para organizar seus pensamentos
                        </small>
                    </div>

                    {{-- Upload de imagens --}}
                    <div class="mb-4">
                        <label class="form-label text-muted small">
                            <i class="bi bi-image me-1"></i>Adicionar imagens de referência
                        </label>
                        <div class="border-2 border-dashed rounded-3 p-4 text-center" 
                             style="border-color: #dee2e6; background-color: #f8f9fa;">
                            <input type="file" name="imagens_descricao[]" id="imagens_descricao"
                                   class="d-none"
                                   accept="image/png,image/jpg,image/jpeg"
                                   multiple
                                   onchange="previewImages(event)">
                            <label for="imagens_descricao" class="btn btn-outline-secondary btn-sm rounded-pill mb-2" style="cursor: pointer;">
                                <i class="bi bi-cloud-upload me-1"></i> Escolher imagens
                            </label>
                            <p class="text-muted small mb-0">PNG, JPG até 5MB cada</p>
                            <div id="image-preview" class="row g-2 mt-3"></div>
                        </div>
                    </div>

                    {{-- Informações complementares --}}
                    <div class="border-top pt-4 mt-4">
                        <button class="btn btn-link text-muted p-0 mb-3 text-decoration-none" 
                                type="button" 
                                onclick="toggleDetails()"
                                style="display: flex; align-items: center;">
                            <i class="bi bi-plus-circle me-2" id="toggleIcon" style="font-size: 1.1rem;"></i>
                            <span>Informações adicionais (opcional)</span>
                        </button>

                        <div class="collapse" id="detalhesAdicionais">
    <div class="row g-3">
        {{-- Status (centralizado no topo) --}}
        <div class="col-md-6 mx-auto">
            <label for="status" class="form-label small text-muted mb-1">Status</label>
            <select name="status" id="status" class="form-select" style="height: 38px; font-size: 0.95rem;">
                @foreach (\App\Enums\OrganizerStatus::cases() as $status)
                    <option value="{{ $status->value }}" 
                            {{ old('status', 'ideia') == $status->value ? 'selected' : '' }}>
                        {{ \App\Enums\OrganizerStatus::labels()[$status->value] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Prazo --}}
        <div class="col-md-6">
            <label for="prazo" class="form-label small text-muted mb-1">Prazo de Entrega</label>
            <input type="date" name="prazo" id="prazo"
                   class="form-control" 
                   style="height: 38px; font-size: 0.95rem;"
                   value="{{ old('prazo') }}">
        </div>

        {{-- Cliente --}}
        <div class="col-md-6">
            <label for="nome_cliente" class="form-label small text-muted mb-1">Cliente</label>
            <input type="text" name="nome_cliente" id="nome_cliente"
                   class="form-control"
                   style="height: 38px; font-size: 0.95rem;"
                   placeholder="Ex: Loja da Ana"
                   value="{{ old('nome_cliente') }}">
        </div>

        {{-- Plataforma --}}
        <div class="col-md-6">
            <label for="plataforma" class="form-label small text-muted mb-1">Plataforma</label>
            <select name="plataforma" id="plataforma" class="form-select" style="height: 38px; font-size: 0.95rem;">
                <option value="">Selecione...</option>
                <option value="instagram" {{ old('plataforma') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                <option value="facebook" {{ old('plataforma') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="tiktok" {{ old('plataforma') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                <option value="linkedin" {{ old('plataforma') == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                <option value="twitter" {{ old('plataforma') == 'twitter' ? 'selected' : '' }}>Twitter/X</option>
                <option value="youtube" {{ old('plataforma') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                <option value="pinterest" {{ old('plataforma') == 'pinterest' ? 'selected' : '' }}>Pinterest</option>
                <option value="outras" {{ old('plataforma') == 'outras' ? 'selected' : '' }}>Outras</option>
            </select>
        </div>

        {{-- Tipo de Conteúdo --}}
        <div class="col-md-6">
            <label for="tipo_conteudo" class="form-label small text-muted mb-1">Tipo de Conteúdo</label>
            <select name="tipo_conteudo" id="tipo_conteudo" class="form-select" style="height: 38px; font-size: 0.95rem;">
                <option value="">Selecione...</option>
                <option value="reels" {{ old('tipo_conteudo') == 'reels' ? 'selected' : '' }}>Reels</option>
                <option value="carrossel" {{ old('tipo_conteudo') == 'carrossel' ? 'selected' : '' }}>Carrossel</option>
                <option value="post_unico" {{ old('tipo_conteudo') == 'post_unico' ? 'selected' : '' }}>Post Único</option>
                <option value="stories" {{ old('tipo_conteudo') == 'stories' ? 'selected' : '' }}>Stories</option>
                <option value="video" {{ old('tipo_conteudo') == 'video' ? 'selected' : '' }}>Vídeo</option>
                <option value="artigo" {{ old('tipo_conteudo') == 'artigo' ? 'selected' : '' }}>Artigo</option>
                <option value="thread" {{ old('tipo_conteudo') == 'thread' ? 'selected' : '' }}>Thread</option>
            </select>
        </div>
    </div>
</div>
    {{-- Botões de ação --}}
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #dee2e6;">
                    <a href="{{ route('organizer') }}" class="btn btn-light rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Cancelar
                    </a>

                    <button type="submit" class="btn text-white rounded-pill px-4 shadow-sm"
                            style="background-color: #f29d35;">
                        <i class="bi bi-check-circle me-1"></i> Salvar Ideia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    

    {{-- Scripts --}}
    <script>
        // Função para toggle do ícone +/-
        function toggleDetails() {
            const icon = document.getElementById('toggleIcon');
            const section = document.getElementById('detalhesAdicionais');
            
            // Aguarda um momento para verificar se está expandido ou não
            setTimeout(() => {
                if (section.classList.contains('show')) {
                    icon.classList.remove('bi-plus-circle');
                    icon.classList.add('bi-dash-circle');
                } else {
                    icon.classList.remove('bi-dash-circle');
                    icon.classList.add('bi-plus-circle');
                }
            }, 100);
            
            // Toggle do collapse
            const bsCollapse = new bootstrap.Collapse(section, {
                toggle: true
            });
        }

        // Preview de imagens
        function previewImages(event) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            
            Array.from(event.target.files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-md-3';
                        
                        col.innerHTML = `
                            <div class="position-relative">
                                <img src="${e.target.result}" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="width: 100%; height: 120px; object-fit: cover;">
                                <button type="button" 
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle"
                                        style="width: 24px; height: 24px; padding: 0; font-size: 12px;"
                                        onclick="removeImage(${index}, this)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        `;
                        
                        preview.appendChild(col);
                    };
                    
                    reader.readAsDataURL(file);
                }
            });
        }

        function removeImage(index, button) {
            button.closest('.col-6, .col-md-3').remove();
            
            if (document.getElementById('image-preview').children.length === 0) {
                document.getElementById('imagens_descricao').value = '';
            }
        }
    </script>
</x-app-layout>