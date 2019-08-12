<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventFormRequest extends FormRequest
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
            'title' =>'required|min:3',
            'description' =>'required|min:5',
        ];
    }

    public function messages() {
        return [
            'required' => 'Ce champ ne peut pas être vide !',
            'title.min' => 'Vous devez entrer un titre au minimum :min caractères !',
            'description.min' => 'Vous devez entrer un :attribute au minimum :min caractères !'
        ];
    }
}
