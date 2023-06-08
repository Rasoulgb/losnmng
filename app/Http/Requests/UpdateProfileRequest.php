<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
 
        return [
            'email' => ['email', 'max:50', 'required', Rule::unique('users')->ignore(request()->session()->get('id'))],
            'firstname' => 'required|max:50',
            'surename' => 'required|max:100',
            'MobileNumber' => 'size:10',
            'Address' => 'max:500',
            'Education' => 'max:50',
        ];


    
    }
}
