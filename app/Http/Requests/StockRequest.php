<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:64',
            'sector_id' => 'required|exists:sectors,id',
            'ceiling_price' => 'numeric|nullable|min:0',
            'quantity' => 'sometimes|integer|nullable|min:0',
            'average_price' => 'sometimes|numeric|nullable|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome não pode ter mais de 64 caracteres.',
            'average_price.numeric' => 'O campo preço médio deve ter um valor numérico.',
            'average_price.min' => 'O campo preço médio deve ter um valor positivo.',
            'ceiling_price.numeric' => 'O campo preço teto deve ter um valor numérico.',
            'ceiling_price.min' => 'O campo preço teto deve ter um valor positivo.',
            'quantity.integer' => 'O campo quantidade deve ser um número inteiro.',
            'quantity.min' => 'O campo quantidade deve ter um valor positivo.',
            'sector_id.required' => 'O campo setor deve ter um valor válido.',
            'sector_id.exists' => 'O campo setor deve ser um dos valores existentes na tabela de setores.'
        ];
    }
}
