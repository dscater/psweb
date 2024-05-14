<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoStoreRequest extends FormRequest
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
            'nom' => 'unique:productos,nom',
            'cod_unico' => 'unique:productos,cod_unico',
        ];
    }

    public function messages()
    {
        return [
            'nom.unique' => 'Este nombre de producto ya existe.',
            'cod_unico.unique' => 'Este código ya fue registrado.',
        ];
    }
}
