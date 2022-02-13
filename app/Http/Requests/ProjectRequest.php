<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
            'repository' => 'required',
            'image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Project title is required',
            'description' => 'Project description is required',
            'link.required' => 'Project link is required',
            'image.required' => 'Project image is required'
        ];
    }
}