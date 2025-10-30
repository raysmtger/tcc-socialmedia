<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\OrganizerStatus;
//use Illuminate\Validation\Rule;

class UpdateIdeaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'titulo'       => ['sometimes', 'string', 'max:150'],
            'descricao'    => ['nullable', 'string'],
            'nome_cliente' => ['nullable', 'string', 'max:120'],
            'prazo'        => ['nullable', 'date'],
            'status'       => ['sometimes', 'in:concluido,em_andamento,ideias'], //require torna obrigatório, sometimes só se for enviado
        ];
    }
}