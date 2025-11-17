<x-app-layout>
    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card shadow-sm border-0 rounded-4" style="border: 3px solid #f8a43d !important;">
                    <div class="card-header text-white rounded-top" style="background-color: #f29d35; border-radius: 20px 20px 0 0 !important;">
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-pencil-square me-2"></i>Gerador de Legendas
                        </h4>
                        <small>Crie legendas criativas para Instagram em segundos</small>
                    </div>

                    <div class="card-body p-4">
                        
                        {{-- Mensagens de erro --}}
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

                        <form action="{{ route('prompt.store.caption') }}" method="POST" id="captionForm">
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
                                    placeholder="Ex: Lançamento de nova coleção de verão"
                                    maxlength="200"
                                    required
                                >
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Sobre o que é o post?
                                </small>
                                @error('tema')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tom de Voz --}}
                            <div class="mb-4">
                                <label for="tom" class="form-label fw-bold text-muted small">
                                    <i class="bi bi-megaphone-fill me-1" style="color: #f29d35;"></i>
                                    Tom de Voz <span class="text-danger">*</span>
                                </label>
                                <select 
                                    class="form-select border-2 rounded-3 @error('tom') is-invalid @enderror" 
                                    id="tom" 
                                    name="tom"
                                    required
                                >
                                    <option value="">Selecione o tom de voz...</option>
                                    <option value="profissional" {{ old('tom') == 'profissional' ? 'selected' : '' }}>
                                        💼 Profissional - Formal e confiável
                                    </option>
                                    <option value="descontraído" {{ old('tom') == 'descontraído' ? 'selected' : '' }}>
                                        😊 Descontraído - Casual e amigável
                                    </option>
                                    <option value="engraçado" {{ old('tom') == 'engraçado' ? 'selected' : '' }}>
                                        😄 Engraçado - Divertido e leve
                                    </option>
                                    <option value="inspirador" {{ old('tom') == 'inspirador' ? 'selected' : '' }}>
                                        ✨ Inspirador - Motivacional
                                    </option>
                                </select>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Como você quer se comunicar?
                                </small>
                                @error('tom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Call-to-Action --}}
                            <div class="mb-4">
                                <label for="cta" class="form-label fw-bold text-muted small">
                                    <i class="bi bi-cursor-fill me-1" style="color: #f29d35;"></i>
                                    Call-to-Action <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control border-2 rounded-3 @error('cta') is-invalid @enderror" 
                                    id="cta" 
                                    name="cta"
                                    value="{{ old('cta') }}"
                                    placeholder="Ex: Visite nosso site, Compre agora, Saiba mais"
                                    maxlength="100"
                                    required
                                >
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Qual ação você quer que o público tome?
                                </small>
                                @error('cta')
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
                                        <i class="bi bi-stars me-1"></i> Gerar Legendas
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

                {{-- Dica --}}
                <div class="alert alert-light border-2 mt-4 rounded-3" style="border-color: #f8a43d !important; background-color: #fff8f0;">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-lightbulb-fill me-2 fs-4" style="color: #f29d35;"></i>
                        <div>
                            <strong style="color: #f29d35;">Dica:</strong>
                            <p class="mb-0 text-dark">
                                Seja específico no tema para obter legendas mais relevantes. 
                                Quanto mais detalhes, melhor será o resultado!
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        // Loading state no botão
        document.getElementById('captionForm').addEventListener('submit', function() {
            document.getElementById('btnText').classList.add('d-none');
            document.getElementById('btnLoading').classList.remove('d-none');
            document.getElementById('generateBtn').disabled = true;
        });
    </script>
</x-app-layout>