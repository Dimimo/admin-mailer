<?php

namespace Dimimo\AdminMailer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListRequest
 * @package Dimimo\AdminMailer\Http\Requests
 */
class CampaignRequest extends FormRequest
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
            'name' => 'required|min:4|max:80|unique:mailer_campaigns,name,'.$id,
            'description' => 'sometimes|max:5000',
            'lists' => 'required',
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
            'name.required' => 'Please enter a name, this has to be unique as well',
            'name.min' => 'The name needs to be at least 4 chars long',
            'name.max' => 'Please shorten the name (max 80 chars)',
            'name.unique' => 'This campaign name already exists, please provide a unique name',
            'description.max' => 'Shorten the description, the maximum aloud input is 5000 chars, including HTML tags',
            'lists.required' => 'Please select at least 1 list',
        ];
    }
}
