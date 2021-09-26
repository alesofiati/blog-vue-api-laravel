<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:6',
            'content' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Preencha o campo titulo',
            'title.min' => 'O campo Titulo Precisa ter no minimo 6 caracteres',
            'content.required' => 'Preencha o conteudo do post',
            'content.min' => 'O conteudo do post precisa ter no minimo 6 caracteres'
        ];
    }
}
