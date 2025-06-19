<?php

// app/Http/Requests/StoreProductRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'sale_price' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $cost = $this->input('cost_price');
            $sale = $this->input('sale_price');

            if ($cost && $sale && $sale < $cost * 1.10) {
                $validator->errors()->add('sale_price', 'O preço de venda deve ser ao menos 10% maior que o custo.');
            }
        });
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();

        if (!empty($data['description'])) {
            $data['description'] = strip_tags($data['description'], '<p><br><b><strong>');
        }

        return $data;
    }
}
