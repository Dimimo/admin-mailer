<?php

namespace Dimimo\AdminMailer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CustomerRequest
 * @package Dimimo\AdminMailer\Http\Requests
 */
class CustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameter('id');

        return [
            'name' => 'required|min:4|max:80',
            'real_name' => 'sometimes|max:80',
            'email' => 'required|email|unique:mailer_customers,email,'.$id,
            'mailer_list_id' => 'required',
            'user_id' => 'sometimes',
            'city_id' => 'present',
            'site_id' => 'sometimes',
            'service_id' => 'sometimes',
            'uuid' => 'unique:mailer_customers,uuid,'.$id,
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
            'email.unique' => 'This email address is already listed',
            'uuid.unique' => 'This uuid has to be unique, refresh the page and try again',
            'mailer_list_id.required' => 'Please select a mailing list',
        ];
    }
}
