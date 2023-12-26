<?php

namespace App\Http\Requests\Api;

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
        if ($this->isMethod('post')) {
            return [
                'amount' => 'required|numeric',
                'description' => 'required|string|max:255',
                'seller_id' => 'required|exists:users,id',
            ];
        } else {
            return [
                'amount' => 'required|numeric',
                'order_id' => 'required|exists:orders,id',
                'seller_id' => 'required|exists:users,id',
            ];
        }
    }
}
