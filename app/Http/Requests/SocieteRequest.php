<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocieteRequest extends FormRequest
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
            'site_internet' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:societes',
            'nom_societe'=>'required|string|min:6',
            'GSM'=>'numeric',
            'ville'=>'string|required',
            'pays'=>'string|required',
            'adresse'=>'string|required',
            'code_postall'=>'numeric|min:5',
            'devise'=>'String|min:3|max:10',
        ];
    }
}
