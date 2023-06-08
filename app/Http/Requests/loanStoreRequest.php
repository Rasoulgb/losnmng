<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loanStoreRequest extends FormRequest
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
            'reciver' => 'required|max:255',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'number_of_instalments' => 'required|numeric|max:1200',
            'each_instalments_amount' => 'required|numeric',
            'reminder' => 'required',
            'what_time' => 'numeric|max:24',
            'how_many_days_earlier' => 'numeric|max:7',
        ];
    }
}
