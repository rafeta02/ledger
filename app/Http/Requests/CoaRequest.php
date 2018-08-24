<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoaRequest extends FormRequest
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
            'code' => 'required|unique:gl_coas|max:20',
            'name' => 'required|max:30',
            'type_id' => 'required',
            'group' => 'required',
            'parent' => 'required',
        ];
    }
}
