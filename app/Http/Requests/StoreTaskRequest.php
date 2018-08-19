<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'description' => 'required|string',
            'task_type_id' => 'required|exists:task_type,id',
            'task_status_id' => 'required|exists:task_status,id',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
