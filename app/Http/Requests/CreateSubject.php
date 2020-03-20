<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubject extends FormRequest
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
            //

            'subject_id' => 'required|unique:subject,subject_id',
            'subject_name' => 'required',
            'year' => 'required',
            'term' => 'required',
            'day' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
            'room' => 'required',
            'user_id' => 'required',
            

        ];
    }
}
