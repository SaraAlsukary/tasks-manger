<?php

namespace Package\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title'=>['required','max:255'],
            'description'=>['required'],
            'statue'=>['required','string'],
            'proirity_id'=>['required','exists:proirities,id'],
            'team_id'=>['required','exists:teams,id'],
        ];
    }
}
