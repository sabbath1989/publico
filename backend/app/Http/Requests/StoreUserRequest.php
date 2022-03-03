<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:2',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|min:9',
            'image' => 'required|min:1|mimes:jpg,png,gif,jpge',
        ];
    }

    public function messages(){
        return [
            'name.required'                 => 'O campo nome é obrigatório',
            'name.min'                      => 'O campo nome deve ter pelo menos 2 caracteres',

            'email.required'                => 'O campo email é obrigatório',
            'email.unique'                  => 'Esse e-mail já está em uso, escolha outro',
            'email.email'                   => 'E-mail inválido',

            'password.required'             => 'O campo senha é obrigatório',
            'password.min'                  => 'O campo senha deve ter pelo menos 6 caracteres',
            'password.confirmed'            => 'Não foi possivel validar a senha',

            'phone.required'                => 'O campo telefone é obrigatório',
            'phone.min'                     => 'O campo telefone é invalido',

            'image.required'                => 'Selecione uma foto',
            'image.min'                     => 'Selecione uma foto',
            'image.mimes'                   => 'Foto inválida',
        ];
    }
}
