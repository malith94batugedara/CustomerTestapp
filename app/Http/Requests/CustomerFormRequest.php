<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
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
        $rules= [
            'name' =>'required|max:255',
            'mobile' =>'required|max:10|digits:10',
            'nic' =>'required',
            'town' =>'required',
            'province'=>'required',
            'district'=>'required'
        ];

        return $rules;
    }
}
