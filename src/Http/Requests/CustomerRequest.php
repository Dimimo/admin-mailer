<?php

namespace Dimimo\AdminMailer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:4|max:80',
            'real_name' => 'sometimes|max:80',
            'email' => 'required|email',
            'mailer_list_id' => 'required',
            'user_id' => 'sometimes',
            'city_id' => 'present',
            'site_id' => 'sometimes',
            'service_id' => 'sometimes',
            'uuid' => 'present',
            'accepts_mail' => 'boolean',
        ];
    }

    /**
     * Return personalized error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter a name, either a company or a person',
            'name.min' => 'The name needs to be at least 4 chars long',
            'name.max' => 'Please shorten the name (max 80 chars)',
            'real_name.max' => 'Please shorten the real name (max 80 chars)',
            'email.required' => 'Please provide an email address',
            'email.email' => 'Please enter a valid email address',
            'mailer_list_id.required' => 'Please select a mailing list',
        ];
    }
}
