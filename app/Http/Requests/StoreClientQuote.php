<?php

namespace App\Http\Requests;

use App\Rules\AtLeastOneCheckboxRule;
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
            'contactzip' => 'nullable',
            'services' => [new AtLeastOneCheckboxRule],
            'event_type' => 'nullable',
            'location_type' => 'nullable',
            'location_name' => 'nullable',
            'event_date' => 'required|date',
            'start' => 'required',
            'start_advertised' => 'required',
            'end' => 'required',
            'guests' => 'required',
            'cars' => 'required',
            'event_address' => 'nullable',
            'event_city' => 'nullable',
            'event_state' => 'nullable',
            'event_zip' => 'nullable',
            'annual_event' => 'nullable',
            'contact_method' => 'nullable',
            'referral' => 'nullable',
            'client_message' => 'nullable'
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
            'event_date.required'  => 'The event date is required',
            'start.required'  => 'The guest arrival time is required',
            'start_advertised.required'  => 'The advertised start time is required',
            'end.required'  => 'The event end time is required',
            'guests.required'  => 'The guest count is required',
            'cars.required'  => 'The car count is required'
        ];
    }
}
