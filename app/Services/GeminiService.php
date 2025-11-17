<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/';
    protected $model = 'gemini-2.5-flash';
    
    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
        
        if (!$this->apiKey) {
            throw new \Exception('Gemini API Key não configurada. Adicione GEMINI_API_KEY no .env');
        }
    }

    /**
     * Gera legendas para posts
     */
    public function generateCaption($tema, $tom, $cta)
    {
        $prompt = "Você é um especialista em social media. Crie 3 legendas criativas para Instagram sobre o tema: '{$tema}'. 

Tom de voz: {$tom}
Call-to-action: {$cta}

Requisitos:
- Cada legenda deve ter entre 100-150 palavras
- Incluir emojis relevantes
- Ser envolvente e autêntica
- Adaptar ao tom de voz escolhido
- Incluir o CTA de forma natural

Formato de resposta:
Legenda 1:
[texto da legenda]

Legenda 2:
[texto da legenda]

Legenda 3:
[texto da legenda]";

        return $this->makeRequest($prompt);
    }

    /**
     * Gera paleta de cores
     */
    public function generateColorPalette($campanha, $sentimento)
    {
        $prompt = "Você é um designer especializado em psicologia das cores. Crie uma paleta de 5 cores para a campanha: '{$campanha}' que transmita o sentimento de '{$sentimento}'.

IMPORTANTE: Responda APENAS com um JSON válido, sem nenhum texto adicional, markdown ou explicações fora do JSON.

Formato OBRIGATÓRIO (JSON puro):
{
  \"cores\": [\"#HEXCODE1\", \"#HEXCODE2\", \"#HEXCODE3\", \"#HEXCODE4\", \"#HEXCODE5\"],
  \"nomes\": [\"Nome Cor 1\", \"Nome Cor 2\", \"Nome Cor 3\", \"Nome Cor 4\", \"Nome Cor 5\"],
  \"justificativa\": \"Explicação de como essas cores transmitem o sentimento desejado (máximo 2 frases).\"
}";

        $response = $this->makeRequest($prompt);
        
        // Remove possíveis markdown code blocks
        $response = preg_replace('/```json\s*/', '', $response);
        $response = preg_replace('/```\s*/', '', $response);
        $response = trim($response);
        
        return $response;
    }

    /**
     * Gera ideias de conteúdo
     */
    public function generateIdeas($nicho, $dataComemorativa, $objetivo)
    {
        $prompt = "Você é um estrategista de conteúdo para redes sociais. Gere 5 ideias criativas de posts para o nicho '{$nicho}' sobre '{$dataComemorativa}'.

Objetivo: {$objetivo}

Para cada ideia, forneça:
- Título/conceito do post
- Descrição breve do conteúdo (2-3 linhas)
- Formato sugerido (carrossel, reels, stories, post único)
- Dica de execução

Formato de resposta:

💡 IDEIA 1: [Título]
Descrição: [descrição]
Formato: [formato]
Dica: [dica de execução]

💡 IDEIA 2: [Título]
Descrição: [descrição]
Formato: [formato]
Dica: [dica de execução]

💡 IDEIA 3: [Título]
Descrição: [descrição]
Formato: [formato]
Dica: [dica de execução]

💡 IDEIA 4: [Título]
Descrição: [descrição]
Formato: [formato]
Dica: [dica de execução]

💡 IDEIA 5: [Título]
Descrição: [descrição]
Formato: [formato]
Dica: [dica de execução]";

        return $this->makeRequest($prompt);
    }

    /**
     * Gera hashtags
     */
    public function generateHashtags($tema, $plataforma, $nicho)
    {
        $prompt = "Você é um especialista em estratégia de hashtags para {$plataforma}. Gere hashtags para um post sobre '{$tema}' no nicho de '{$nicho}'.

Crie 3 grupos de hashtags:

🔥 HASHTAGS POPULARES (Alto alcance - 100k+ posts):
[liste 5 hashtags muito populares]

🎯 HASHTAGS NICHADAS (Médio alcance - 10k-100k posts):
[liste 5 hashtags específicas do nicho]

💎 HASHTAGS DE COMUNIDADE (Baixo alcance - menos de 10k posts):
[liste 5 hashtags mais específicas e engajadas]

DICA ESTRATÉGICA:
[dica de como combinar essas hashtags para melhor desempenho]";

        return $this->makeRequest($prompt);
    }

    /**
     * Gera CTAs (Call-to-Action)
     */
    public function generateCTA($objetivo, $produto)
    {
        $prompt = "Você é um copywriter especializado em conversão. Crie 8 CTAs (Call-to-Action) persuasivos para '{$produto}' com objetivo de '{$objetivo}'.

Requisitos:
- CTAs curtos e diretos (máximo 10 palavras cada)
- Criar senso de urgência quando apropriado
- Usar verbos de ação
- Variar entre diferentes abordagens (emocional, racional, urgência, benefício)

Formato de resposta:

🎯 CTA 1: [texto do CTA]

🎯 CTA 2: [texto do CTA]

🎯 CTA 3: [texto do CTA]

🎯 CTA 4: [texto do CTA]

🎯 CTA 5: [texto do CTA]

🎯 CTA 6: [texto do CTA]

🎯 CTA 7: [texto do CTA]

🎯 CTA 8: [texto do CTA]

💡 DICA DE USO:
[dica estratégica sobre quando e como usar cada tipo de CTA]";

        return $this->makeRequest($prompt);
    }

    /**
     * Método genérico para fazer requisições à API
     */
    protected function makeRequest($prompt)
    {
        try {
            $url = $this->baseUrl . $this->model . ':generateContent';
            
            $response = Http::timeout(60)
                ->post($url . '?key=' . $this->apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.9,
                        'topK' => 40,
                        'topP' => 0.95,
                        'maxOutputTokens' => 2048,
                    ]
                ]);

            if (!$response->successful()) {
                \Log::error('Erro na API Gemini', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                throw new \Exception('Erro na API: ' . $response->status());
            }

            $data = $response->json();

            if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                \Log::error('Formato inesperado da API Gemini', ['response' => $data]);
                throw new \Exception('Formato de resposta inesperado da API');
            }

            return $data['candidates'][0]['content']['parts'][0]['text'];

        } catch (\Exception $e) {
            \Log::error('Erro no GeminiService', [
                'message' => $e->getMessage(),
                'prompt' => substr($prompt, 0, 200)
            ]);
            throw $e;
        }
    }
}