<x-app-layout>
    <div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card shadow-sm border-0 rounded-4" style="border: 3px solid #f8a43d !important;">
                <div class="card-header text-white rounded-top" style="background-color: #f29d35; border-radius: 20px 20px 0 0 !important;">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-palette-fill me-2"></i>Gerador de Paleta de Cores
                    </h4>
                    <small>Crie paletas harmônicas para suas campanhas</small>
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

                    <form action="{{ route('prompt.store.palette') }}" method="POST" id="paletteForm">
                        @csrf

                        {{-- Tipo de Campanha --}}
                        <div class="mb-4">
                            <label for="campanha" class="form-label fw-bold text-muted small">
                                <i class="bi bi-calendar-event-fill me-1" style="color: #f29d35;"></i>
                                Tipo de Campanha <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control border-2 rounded-3 @error('campanha') is-invalid @enderror" 
                                id="campanha" 
                                name="campanha"
                                value="{{ old('campanha') }}"
                                placeholder="Ex: Lançamento de produto, Black Friday, Dia das Mães"
                                maxlength="200"
                                required
                            >
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Qual é o contexto ou ocasião da campanha?
                            </small>
                            @error('campanha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sentimento --}}
                        <div class="mb-4">
                            <label for="sentimento" class="form-label fw-bold text-muted small">
                                <i class="bi bi-emoji-smile-fill me-1" style="color: #f29d35;"></i>
                                Sentimento Desejado <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control border-2 rounded-3 @error('sentimento') is-invalid @enderror" 
                                id="sentimento" 
                                name="sentimento"
                                value="{{ old('sentimento') }}"
                                placeholder="Ex: Confiança, Energia, Sofisticação, Alegria, Tranquilidade"
                                maxlength="100"
                                required
                            >
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Que emoção você quer transmitir?
                            </small>
                            @error('sentimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sugestões de Sentimentos --}}
                        <div class="mb-4">
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-lightbulb-fill" style="color: #f29d35;"></i>
                                Sugestões de sentimentos:
                            </small>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="btn btn-sm rounded-pill" 
                                        style="border: 2px solid #f8a43d; color: #f29d35;"
                                        onclick="setSentimento('Confiança e Profissionalismo')">
                                    Confiança
                                </button>
                                <button type="button" class="btn btn-sm rounded-pill" 
                                        style="border: 2px solid #f8a43d; color: #f29d35;"
                                        onclick="setSentimento('Energia e Vitalidade')">
                                    Energia
                                </button>
                                <button type="button" class="btn btn-sm rounded-pill" 
                                        style="border: 2px solid #f8a43d; color: #f29d35;"
                                        onclick="setSentimento('Sofisticação e Elegância')">
                                    Elegância
                                </button>
                                <button type="button" class="btn btn-sm rounded-pill" 
                                        style="border: 2px solid #f8a43d; color: #f29d35;"
                                        onclick="setSentimento('Alegria e Diversão')">
                                    Alegria
                                </button>
                                <button type="button" class="btn btn-sm rounded-pill" 
                                        style="border: 2px solid #f8a43d; color: #f29d35;"
                                        onclick="setSentimento('Tranquilidade e Paz')">
                                    Tranquilidade
                                </button>
                                <button type="button" class="btn btn-sm rounded-pill" 
                                        style="border: 2px solid #f8a43d; color: #f29d35;"
                                        onclick="setSentimento('Luxo e Exclusividade')">
                                    Luxo
                                </button>
                                <button type="button" class="btn btn-sm rounded-pill" 
                                        style="border: 2px solid #f8a43d; color: #f29d35;"
                                        onclick="setSentimento('Juventude e Modernidade')">
                                    Moderno
                                </button>
                            </div>
                        </div>

                        {{-- Botões --}}
                        <div class="d-flex gap-2 justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #dee2e6;">
                            <a href="{{ route('prompt.index') }}" class="btn btn-light rounded-pill px-4">
                                <i class="bi bi-arrow-left me-1"></i> Voltar
                            </a>

                            <button type="submit" class="btn text-white rounded-pill px-4 shadow-sm" id="generateBtn"
                                    style="background-color: #f29d35;">
                                <span id="btnText">
                                    <i class="bi bi-stars me-1"></i> Gerar Paleta
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
                            A IA irá criar uma paleta de 5 cores harmonizadas que transmitem o sentimento escolhido. 
                            Perfeito para manter consistência visual nas suas redes sociais!
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    function setSentimento(valor) {
        document.getElementById('sentimento').value = valor;
    }

    document.getElementById('paletteForm').addEventListener('submit', function() {
        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnLoading').classList.remove('d-none');
        document.getElementById('generateBtn').disabled = true;
    });
</script>
</x-app-layout>