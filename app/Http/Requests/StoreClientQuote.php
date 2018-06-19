<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientQuote extends FormRequest
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
            'social_title' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'company' => 'nullable',
            'phone' => 'required|phone:US',
            'phone_ext' => 'nullable',
            'fax' => 'nullable',
            'email' => 'required|email',
            'contact_address' => 'nullable',
            'contact_city' => 'nullable',
            'contact_state' => 'nullable',
            'contactzip' => 'nullable'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'social_title.required' => 'Your title is required',
            'fname.required'  => 'Your first name is required',
            'lname.required'  => 'Your last name is required',
            'phone.required'  => 'Your phone is required',
            'email.required'  => 'Your email is required',
        ];
    }
}
