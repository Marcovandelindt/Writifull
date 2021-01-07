<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserRequest extends FormRequest
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
           'name'     => 'required|max:255',
           'username' => 'required|max:20',
           'email'    => 'email|required|max:255',
           'image'    => 'image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
