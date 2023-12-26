<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'seller_id' => 'required|exists:users,id',
            'order_state_id' => 'required|exists:order_states,id',
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            'date_expiration' => 'nullable|date',
        ];
    }
}
