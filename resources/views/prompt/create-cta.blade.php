<x-app-layout>
    <div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card shadow-sm border-0 rounded-4" style="border: 3px solid #f8a43d !important;">
                <div class="card-header text-white rounded-top" style="background-color: #f29d35; border-radius: 20px 20px 0 0 !important;">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-cursor-fill me-2"></i>Gerador de Call-to-Action
                    </h4>
                    <small>Crie CTAs persuasivos que convertem</small>
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

                    <form action="{{ route('prompt.store.cta') }}" method="POST" id="ctaForm">
                        @csrf

                        {{-- Objetivo --}}
                        <div class="mb-4">
                            <label for="objetivo" class="form-label fw-bold text-muted small">
                                <i class="bi bi-target me-1" style="color: #f29d35;"></i>
                                Objetivo do CTA <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select border-2 rounded-3 @error('objetivo') is-invalid @enderror" 
                                id="objetivo" 
                                name="objetivo"
                                required
                            >
                                <option value="">Selecione o objetivo...</option>
                                <option value="venda" {{ old('objetivo') == 'venda' ? 'selected' : '' }}>
                                    💰 Venda - Converter em compra
                                </option>
                                <option value="engajamento" {{ old('objetivo') == 'engajamento' ? 'selected' : '' }}>
                                    💬 Engajamento - Comentários e interações
                                </option>
                                <option value="trafego" {{ old('objetivo') == 'trafego' ? 'selected' : '' }}>
                                    🔗 Tráfego - Levar para o site/link
                                </option>
                                <option value="cadastro" {{ old('objetivo') == 'cadastro' ? 'selected' : '' }}>
                                    📝 Cadastro - Captar leads/emails
                                </option>
                                <option value="download" {{ old('objetivo') == 'download' ? 'selected' : '' }}>
                                    📥 Download - Baixar material/app
                                </option>
                            </select>
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Qual ação você quer que o público realize?
                            </small>
                            @error('objetivo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Produto/Serviço --}}
                        <div class="mb-4">
                            <label for="produto" class="form-label fw-bold text-muted small">
                                <i class="bi bi-box-seam me-1" style="color: #f29d35;"></i>
                                Produto ou Serviço <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control border-2 rounded-3 @error('produto') is-invalid @enderror" 
                                id="produto" 
                                name="produto"
                                value="{{ old('produto') }}"
                                placeholder="Ex: Curso de Marketing Digital, Ebook de Receitas, Consultoria"
                                maxlength="200"
                                required
                            >
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                O que você está oferecendo?
                            </small>
                            @error('produto')
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
                                    <i class="bi bi-stars me-1"></i> Gerar CTAs
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
                        <strong style="color: #f29d35;">Dica:</strong>
                        <p class="mb-0 text-dark">
                            Um bom CTA é claro, direto e cria senso de urgência. 
                            A IA vai gerar múltiplas opções para você testar qual converte melhor!
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    document.getElementById('ctaForm').addEventListener('submit', function() {
        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnLoading').classList.remove('d-none');
        document.getElementById('generateBtn').disabled = true;
    });
</script>
</x-app-layout>