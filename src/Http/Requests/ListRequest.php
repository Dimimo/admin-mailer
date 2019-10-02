<?php

namespace Dimimo\AdminMailer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListRequest
 * @package Dimimo\AdminMailer\Http\Requests
 */
class ListRequest extends FormRequest
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
            'name' => 'required|min:4|max:80|unique:mailer_lists,name,'.$id,
            'city_id' => 'present',
            'description' => 'sometimes|max:5000',
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
            'name.required' => 'Please enter a name',
            'name.min' => 'The name needs to be at least 4 chars long',
            'name.max' => 'Please shorten the name (max 80 chars)',
            'name.unique' => 'This list name already exists, please provide a unique name',
            'description.max' => 'Shorten the description, the maximum aloud input is 5000 chars, including HTML tags',
        ];
    }
}
