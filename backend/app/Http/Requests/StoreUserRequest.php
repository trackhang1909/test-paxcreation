<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'full_name' => 'required|max:255',
            'phone' => 'required|max:20',
            'sex' => 'required|integer',
            'image' => 'required',
            'department' => 'required|integer',
            'type' => 'required|integer',
        ];
    }
}
