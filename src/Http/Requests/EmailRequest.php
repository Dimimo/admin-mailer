<?php

namespace Dimimo\AdminMailer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListRequest
 * @package Dimimo\AdminMailer\Http\Requests
 */
class EmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this->request);
        return [
            'mailer_campaign_id' => 'required',
            'title' => 'required|min:4|max:80',
            'body' => 'required|min:10|max:10000',
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
            'title.required' => 'Please enter a title',
            'title.min' => 'The title needs to be at least 4 chars long',
            'title.max' => 'Please shorten the title (max 80 chars)',
            'body.required' => 'Please create the email content, we can\'t send an empty email',
            'body.min' => 'The email content is too short, it should be minimum 50 characters long',
            'body.max' => 'Shorten the email, the maximum aloud input is 10000 chars, including HTML tags',
            'mailer_campaign_id.required' => 'A Campaign has to be selected',
        ];
    }
}
