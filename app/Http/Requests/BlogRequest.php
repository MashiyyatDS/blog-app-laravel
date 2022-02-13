<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'content' => 'required',
            'category' => 'required',
            'image' => 'required|min:1'
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Blog title is required',
            'content.required' => 'Blog content is required',
            'category.required' => 'Blog category is required',
            'image.required' => 'Blog image is required',
            'image.min' => 'Please attach some image'
        ];
    }
}
