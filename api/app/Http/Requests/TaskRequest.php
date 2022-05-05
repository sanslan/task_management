<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskRequest extends FormRequest
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
        $rules =  [
            'title' => 'required|unique:tasks|max:255',
            'description' => 'required',
            'status' => 'required|max:255',
            'duration' => 'required|max:255',
            'project_id' => 'required|integer|exists:projects,id,deleted_at,NULL'
        ];


        if (in_array($this->method(), ['PUT', 'PATCH'])){
            $rules['title'] = 'required|unique:tasks,title,'.$this->task->id. '|max:255';
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => -1,
            'validation_errors ' => $validator->errors()->all()
        ], 200));
    }
}
