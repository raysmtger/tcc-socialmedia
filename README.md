# Mídia Ateliê

Sistema web de gerenciamento de mídias sociais desenvolvido como Trabalho de Conclusão de Curso, utilizando Laravel como framework principal e integração com IA generativa.

---

## 🎯 Objetivo do Projeto

O **Mídia Ateliê** tem como objetivo facilitar o trabalho de profissionais de mídias sociais, oferecendo uma plataforma integrada para:

- **Organizar ideias de conteúdo** de forma visual e categorizada
- **Gerar conteúdo criativo** utilizando IA (Google Gemini)
- **Centralizar informações** de projetos, clientes e prazos
- **Agilizar o processo criativo** com assistência inteligente

**Exemplo de uso prático:** Um social media pode criar um card de ideia para o cliente "Padaria X" sobre "Dia do Pão", marcar como "agendado" para o Instagram (Carrossel), anexar imagens de referência, e depois usar o Assistente IA para gerar legendas criativas, hashtags relevantes e paleta de cores para o design.

---

## Funcionalidades Principais

### Organizador
* Criar, editar e excluir ideias de conteúdo
* Organização por status (Ideia, Rascunho, Agendado, Publicado)
* Gerenciamento de clientes
* Categorização por plataforma (Instagram, Facebook, TikTok)
* Tipos de conteúdo (Reels, Carrossel, Stories, Post Único)
* Controle de prazos e deadlines
* Upload de anexos 
* Busca e filtros avançados
* Interface visual com cards coloridos

### Módulo Assistente IA
* **Gerador de Legendas**: Cria legendas criativas com tom de voz personalizável
* **Gerador de Paleta de Cores**: Sugere combinações baseadas no sentimento da campanha
* **Gerador de Ideias de Conteúdo**: Propõe conceitos criativos para datas comemorativas
* **Gerador de Hashtags**: Recomenda hashtags populares, nichadas e de comunidade
* **Gerador de CTAs**: Cria chamadas para ação persuasivas
* Sistema de favoritos
* Histórico de gerações
* Armazenamento de resultados

###  Sistema de Autenticação
* Login e registro de usuários (Laravel Breeze)
* Recuperação de senha
* Gerenciamento de perfil
---

## Tecnologias Utilizadas

### Backend
- **Framework:** Laravel 12.21.0
- **Banco de dados:** MySQL
- **Autenticação:** Laravel Breeze
- **IA:** Google Gemini API (gemini-2.5-flash)
- **Gerenciador de Dependências:** Composer
- **Versionamento:** Git/GitHub

### Frontend
- **Templates:** Blade
- **Marcação:** HTML5, CSS3
- **Framework CSS:** Bootstrap 5.3.2
- **Ícones:** Bootstrap Icons
- **Fonte:** Google Fonts (Poppins)
- **Gerenciador de Dependências:** NPM

---

## Levantamento de Requisitos

###  Requisitos Funcionais

#### 2.1 Módulo de Autenticação
| ID | Requisito | Prioridade | Descrição |
|----|-----------|------------|-----------|
| RF01 | Cadastro de usuário | Alta | O sistema deve permitir que novos usuários se cadastrem informando nome, email e senha |
| RF02 | Login de usuário | Alta | O sistema deve permitir que usuários façam login com email e senha |
| RF03 | Logout de usuário | Alta | O sistema deve permitir que o usuário encerre sua sessão |
| RF04 | Recuperação de senha | Média | O sistema deve permitir que o usuário recupere sua senha via email |
| RF05 | Validação de email | Alta | O sistema deve validar formato e unicidade do email |
| RF06 | Criptografia de senha | Alta | O sistema deve armazenar senhas de forma criptografada (bcrypt) |

#### 2.2 Módulo Organizador
| ID | Requisito | Prioridade | Descrição |
|----|-----------|------------|-----------|
| RF07 | Criar ideia | Alta | O sistema deve permitir criar novas ideias de conteúdo |
| RF08 | Editar ideia | Alta | O sistema deve permitir editar ideias existentes |
| RF09 | Excluir ideia | Alta | O sistema deve permitir excluir ideias |
| RF10 | Visualizar ideia | Alta | O sistema deve exibir detalhes completos da ideia |
| RF11 | Listar ideias | Alta | O sistema deve exibir todas as ideias do usuário |
| RF12 | Definir status | Alta | O sistema deve permitir definir status (Ideia, Rascunho, Agendado, Publicado) |
| RF13 | Definir cliente | Média | O sistema deve permitir associar cliente à ideia |
| RF14 | Definir plataforma | Alta | O sistema deve permitir escolher plataforma (Instagram, Facebook, TikTok) |
| RF15 | Definir tipo de conteúdo | Alta | O sistema deve permitir escolher tipo (Reels, Carrossel, Stories, Post) |
| RF16 | Definir deadline | Média | O sistema deve permitir definir prazo de entrega |
| RF17 | Upload de anexos | Alta | O sistema deve permitir anexar imagens e documentos |
| RF18 | Visualizar anexos | Alta | O sistema deve permitir visualizar/baixar anexos |
| RF19 | Excluir anexos | Média | O sistema deve permitir remover anexos |
| RF20 | Buscar ideias | Alta | O sistema deve permitir buscar por título e descrição |
| RF21 | Filtrar por status | Alta | O sistema deve permitir filtrar ideias por status |
| RF22 | Filtrar por cliente | Média | O sistema deve permitir filtrar por cliente |
| RF23 | Filtrar por plataforma | Média | O sistema deve permitir filtrar por plataforma |
| RF24 | Filtrar por tipo de conteúdo | Média | O sistema deve permitir filtrar por tipo |
| RF25 | Filtrar por período | Média | O sistema deve permitir filtrar por datas |

#### 2.3 Módulo Assistente IA
| ID | Requisito | Prioridade | Descrição |
|----|-----------|------------|-----------|
| RF26 | Gerar legendas | Alta | O sistema deve gerar 3 legendas criativas usando IA |
| RF27 | Personalizar tom de voz | Alta | O sistema deve permitir escolher tom (profissional, descontraído, etc) |
| RF28 | Incluir CTA em legenda | Alta | O sistema deve permitir definir call-to-action |
| RF29 | Gerar paleta de cores | Alta | O sistema deve gerar 5 cores com justificativa |
| RF30 | Definir sentimento | Alta | O sistema deve permitir escolher sentimento da paleta |
| RF31 | Gerar ideias de conteúdo | Alta | O sistema deve gerar 5 ideias criativas |
| RF32 | Associar data comemorativa | Média | O sistema deve considerar datas especiais |
| RF33 | Gerar hashtags | Alta | O sistema deve gerar hashtags categorizadas (populares, nichadas, comunidade) |
| RF34 | Gerar CTAs | Alta | O sistema deve gerar 8 CTAs persuasivos |
| RF35 | Visualizar resultado | Alta | O sistema deve exibir resultado formatado |
| RF36 | Copiar resultado | Alta | O sistema deve permitir copiar conteúdo gerado |
| RF37 | Favoritar resultado | Média | O sistema deve permitir marcar resultados como favoritos |
| RF38 | Visualizar histórico | Alta | O sistema deve exibir todas as gerações anteriores |
| RF39 | Filtrar histórico por tipo | Média | O sistema deve permitir filtrar por tipo de geração |
| RF40 | Filtrar histórico por favoritos | Baixa | O sistema deve filtrar apenas favoritos |
| RF41 | Excluir do histórico | Média | O sistema deve permitir excluir gerações antigas |

### 🔧 Requisitos Não Funcionais

#### 3.1 Usabilidade
| ID | Requisito | Descrição |
|----|-----------|-----------|
| RNF01 | Interface intuitiva | O sistema deve ter interface moderna e fácil de usar |
| RNF02 | Responsividade | O sistema deve funcionar em desktop, tablets e mobile |
| RNF03 | Feedback visual | O sistema deve fornecer feedback claro para ações do usuário |
| RNF04 | Paleta de cores consistente | O sistema deve usar paleta laranja (#f29d35, #f8a43d, #ffa550) |
| RNF05 | Tempo de aprendizado | Usuário deve dominar funcionalidades básicas em 15 minutos |

#### 3.2 Desempenho
| ID | Requisito | Descrição |
|----|-----------|-----------|
| RNF06 | Tempo de resposta | Páginas devem carregar em até 3 segundos |
| RNF07 | Geração IA | Respostas da IA devem retornar em até 10 segundos |
| RNF08 | Upload assíncrono | Upload de arquivos não deve travar interface |
| RNF09 | Paginação | Listas grandes devem usar paginação |
| RNF10 | Cache | Sistema deve usar cache quando apropriado |

#### 3.3 Segurança
| ID | Requisito | Descrição |
|----|-----------|-----------|
| RNF11 | Autenticação segura | Sistema deve usar Laravel Breeze |
| RNF12 | Criptografia de senhas | Senhas devem usar bcrypt |
| RNF13 | Validação de entrada | Todos os dados devem ser validados |
| RNF14 | Isolamento de dados | Cada usuário acessa apenas seus dados |
| RNF15 | Proteção de API Key | Chave da Gemini deve estar em .env |
| RNF16 | Proteção SQL Injection | Sistema deve usar Eloquent ORM |
| RNF17 | Validação de upload | Arquivos devem ser validados (tipo e tamanho) |

#### 3.4 Confiabilidade
| ID | Requisito | Descrição |
|----|-----------|-----------|
| RNF18 | Tratamento de erros | Sistema deve tratar erros da API graciosamente |
| RNF19 | Logs | Sistema deve registrar erros em logs |
| RNF20 | Validação de JSON | Respostas da IA devem ser validadas |
---

## 💻 Instalação e Configuração

### 📦 Pré-requisitos
- PHP >= 8.2
- Composer
- Node.js e NPM
- MySQL
- Git
- Chave da API Google Gemini

### 1️⃣ Clonar o repositório
```bash
git clone https://github.com/raysmtger/tcc-socialmedia.git
cd tcc-socialmedia
```

### 2️⃣ Instalar dependências PHP
```bash
composer install
```

### 3️⃣ Instalar dependências Node.js
```bash
npm install
```

### 4️⃣ Configurar arquivo .env
```bash
cp .env.example .env
```

Edite o `.env` com suas configurações:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=midiaia
DB_USERNAME=root
DB_PASSWORD=

GEMINI_API_KEY=sua_chave_aqui
```

### 5️⃣ Gerar chave da aplicação
```bash
php artisan key:generate
```

### 6️⃣ Executar migrations
```bash
php artisan migrate
```

### 7️⃣ Criar link simbólico do storage
```bash
php artisan storage:link
```

### 8️⃣ Compilar assets
```bash
npm run dev
```

### 9️⃣ Iniciar servidor
```bash
php artisan serve
```
---

## Obtendo a Chave da API Gemini

1. Acesse: [Google AI Studio](https://aistudio.google.com/app/apikey)
2. Clique em "Create API Key"
3. Copie a chave gerada
4. Cole no arquivo `.env` em `GEMINI_API_KEY=`

---


## Autor

**Rayssa Metzger**
- Curso: Análise e Desenvolvimento de Sistemas
- Instituição: Uniguairacá
- Ano: 2025

---

## 📄 Licença

Este projeto foi desenvolvido como Trabalho de Conclusão de Curso (TCC).
