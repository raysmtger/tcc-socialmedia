<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\OrganizerStatus; 

class StoreIdeaRequest extends FormRequest
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
        ];
    }
}
