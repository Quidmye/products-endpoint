<?php

namespace Quidmye\ProductsEndpoint\App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ProductsFormattingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products' => 'array|required',
            'products.*.name' => 'required|string|min:5|max:255',
            'products.*.price' => 'required|numeric',
            'products.*.image' => 'required|url',
            'products.*.category' => 'required|string|max:255'
        ];
    }

}
