<x-app-layout>
    <div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card shadow-sm border-0 rounded-4" style="border: 3px solid #f8a43d !important;">
                <div class="card-header text-white rounded-top" style="background-color: #f29d35; border-radius: 20px 20px 0 0 !important;">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-hash me-2"></i>Gerador de Hashtags
                    </h4>
                    <small>Aumente o alcance dos seus posts com hashtags estratégicas</small>
                </div>

                <div class="card-body p-4">
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Atenção!</strong> Corrija os erros abaixo:
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('prompt.store.hashtags') }}" method="POST" id="hashtagsForm">
                        @csrf

                        {{-- Tema --}}
                        <div class="mb-4">
                            <label for="tema" class="form-label fw-bold text-muted small">
                                <i class="bi bi-tag-fill me-1" style="color: #f29d35;"></i>
                                Tema do Post <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control border-2 rounded-3 @error('tema') is-invalid @enderror" 
                                id="tema" 
                                name="tema"
                                value="{{ old('tema') }}"
                                placeholder="Ex: Receita de bolo de chocolate, Dicas de maquiagem para iniciantes"
                                maxlength="200"
                                required
                            >
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Sobre o que é o seu post?
                            </small>
                            @error('tema')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Plataforma --}}
                        <div class="mb-4">
                            <label for="plataforma" class="form-label fw-bold text-muted small">
                                <i class="bi bi-phone-fill me-1" style="color: #f29d35;"></i>
                                Plataforma <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select border-2 rounded-3 @error('plataforma') is-invalid @enderror" 
                                id="plataforma" 
                                name="plataforma"
                                required
                            >
                                <option value="">Selecione a plataforma...</option>
                                <option value="Instagram" {{ old('plataforma') == 'Instagram' ? 'selected' : '' }}>
                                    📸 Instagram
                                </option>
                                <option value="TikTok" {{ old('plataforma') == 'TikTok' ? 'selected' : '' }}>
                                    🎵 TikTok
                                </option>
                                <option value="LinkedIn" {{ old('plataforma') == 'LinkedIn' ? 'selected' : '' }}>
                                    💼 LinkedIn
                                </option>
                                <option value="Facebook" {{ old('plataforma') == 'Facebook' ? 'selected' : '' }}>
                                    👥 Facebook
                                </option>
                                <option value="Twitter" {{ old('plataforma') == 'Twitter' ? 'selected' : '' }}>
                                    🐦 Twitter/X
                                </option>
                            </select>
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Onde você vai publicar?
                            </small>
                            @error('plataforma')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nicho --}}
                        <div class="mb-4">
                            <label for="nicho" class="form-label fw-bold text-muted small">
                                <i class="bi bi-bullseye me-1" style="color: #f29d35;"></i>
                                Nicho do Negócio <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control border-2 rounded-3 @error('nicho') is-invalid @enderror" 
                                id="nicho" 
                                name="nicho"
                                value="{{ old('nicho') }}"
                                placeholder="Ex: Gastronomia, Moda, Fitness, Tecnologia, Beleza"
                                maxlength="100"
                                required
                            >
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Qual é o seu nicho ou área de atuação?
                            </small>
                            @error('nicho')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Botões --}}
                        <div class="d-flex gap-2 justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #dee2e6;">
                            <a href="{{ route('prompt.index') }}" class="btn btn-light rounded-pill px-4">
                                <i class="bi bi-arrow-left me-1"></i> Voltar
                            </a>

                            <button type="submit" class="btn text-white rounded-pill px-4 shadow-sm" id="generateBtn"
                                    style="background-color: #f29d35;">
                                <span id="btnText">
                                    <i class="bi bi-stars me-1"></i> Gerar Hashtags
                                </span>
                                <span id="btnLoading" class="d-none">
                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                    Gerando...
                                </span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <div class="alert alert-light border-2 mt-4 rounded-3" style="border-color: #f8a43d !important; background-color: #fff8f0;">
                <div class="d-flex align-items-start">
                    <i class="bi bi-lightbulb-fill me-2 fs-4" style="color: #f29d35;"></i>
                    <div>
                        <strong style="color: #f29d35;">Estratégia de Hashtags:</strong>
                        <ul class="mb-0 mt-2">
                            <li>A IA vai gerar hashtags <strong>populares</strong> (alto alcance) e <strong>nichadas</strong> (maior engajamento)</li>
                            <li>Use de 10-15 hashtags no Instagram para melhor desempenho</li>
                            <li>No LinkedIn, use apenas 3-5 hashtags mais relevantes</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    document.getElementById('hashtagsForm').addEventListener('submit', function() {
        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnLoading').classList.remove('d-none');
        document.getElementById('generateBtn').disabled = true;
    });
</script>
  
</x-app-layout>