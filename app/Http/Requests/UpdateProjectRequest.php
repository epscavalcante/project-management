<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:projects,name,'.$this->get('name'),
            'description' => 'present|nullable',
            'start' => 'nullable|date',
            'end' => 'nullable|date',
            // 'visibility' => [
            //     'required',
            //     Rule::in(['private', 'public']),
            // ]
        ];
    }
}
