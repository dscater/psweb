<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedidaStoreRequest extends FormRequest
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
            'nom' => 'unique:medidas,nom',
            'simbolo' => 'unique:medidas,simbolo',
        ];
    }

    public function messages()
    {
        return [
            'nom.unique' => 'Esta medida ya existe.',
            'simbolo.unique' => 'Esta simbolo esta siendo utilizado.',
        ];
    }
}
