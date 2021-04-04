<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateOrEditRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|string|max:50',
            'short_description' => 'string|max:255|nullable',
            'full_description' => 'string|max:255|nullable',
        ];
    }

    public function messages() {
        return [
            'title.required' => 'A title is required',
            'title.max' => 'Input title within 50 characters',
            'short_description.max' => 'Input short_description within 255 characters',
            'full_description.max' => 'Input full_description within 255 characters',
        ];
    }
}
