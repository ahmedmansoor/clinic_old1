<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            'nid' => 'required|string|unique:patients,nid|max:20',
            'gender' => 'required|string',
            'address' => 'string|max:20|nullable',
            'island' => 'string|max:20|nullable',
            'atoll' => 'string|max:20|nullable',
            'city' => 'string|max:20|nullable',
            'country' => 'string|max:20|nullable',
            'phone_number' => 'required|digits:7|numeric|unique:patients,phone_number',
            'email' => 'required|email|unique:patients,email',
            'dob' => 'required|date',
            'marital_status' => 'numeric|max:2|nullable',
            'emergency_contact' => 'string|max:20|nullable|nullable',
            'emergency_contact_number' => 'numeric|digits:7|nullable',
            'drug_allergies' => 'string|max:20|nullable',
            'food_allergies' => 'string|max:20|nullable',
        ];
    }
}
