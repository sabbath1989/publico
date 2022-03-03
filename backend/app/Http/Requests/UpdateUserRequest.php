<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'email' => 'required|unique:users,email,'.request()->id.'|email',
            'phone' => 'required|min:9',
            //'image' => 'mimes:jpg,png,gif,jpge',
        ];
    }

    public function messages(){
        return [
            'name.required'                 => 'O campo nome é obrigatório',
            'name.min'                      => 'O campo nome deve ter pelo menos 2 caracteres',

            'email.required'                => 'O campo email é obrigatório',
            'email.unique'                  => 'Esse e-mail já está em uso, escolha outro',
            'email.email'                   => 'E-mail inválido',

            'phone.required'                => 'O campo telefone é obrigatório',
            'phone.min'                     => 'O campo telefone é invalido',

            #'image.required'                => 'Selecione uma foto',
            #'image.min'                     => 'Selecione uma foto',
            //'image.mimes'                   => 'Foto inválida',
        ];
    }
}
