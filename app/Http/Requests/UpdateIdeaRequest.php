<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\OrganizerStatus; 

class UpdateIdeaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'titulo'       => ['required', 'string', 'max:150'],
            'descricao'    => ['nullable', 'string'],
            'nome_cliente' => ['nullable', 'string', 'max:120'],
            'prazo'        => ['nullable', 'date'],
            'status'       => ['required', Rule::in(array_column(OrganizerStatus::cases(), 'value'))],
            'plataforma'    => ['nullable', 'string', 'max:255'],
            'tipo_conteudo' => ['nullable', 'string', 'max:255'],
            'anexos'        => ['nullable', 'array', 'max:5'],
            'anexos.*'      => ['file', 'mimes:pdf,png,jpg,jpeg', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais de 150 caracteres.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status selecionado é inválido.',
            'anexos.max' => 'Você pode enviar no máximo 5 arquivos.',
            'anexos.*.file' => 'Cada anexo deve ser um arquivo válido.',
            'anexos.*.mimes' => 'Os anexos devem ser arquivos PDF, PNG, JPG ou JPEG.',
            'anexos.*.max' => 'Cada anexo não pode ter mais de 10MB.',
        ];
    }
}