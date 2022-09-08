<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
        $nid = $this->request->get("nid");
        $phone_number = $this->request->get("phone_number");
        $email = $this->request->get("email");

        return [
            'name' => 'string|max:20',
            'nid' => 'string|max:20',
            'nid' => ['required', Rule::unique('patients')->ignore($nid, 'nid')],
            'gender' => 'string',
            'address' => 'string|max:20|nullable',
            'island' => 'string|max:20|nullable',
            'atoll' => 'string|max:20|nullable',
            'city' => 'string|max:20|nullable',
            'country' => 'string|max:20|nullable',
            'phone_number' => 'digits:7|numeric|unique:patients,phone_number',
            'phone_number' => ['required', Rule::unique('patients')->ignore($phone_number, 'phone_number')],
            'email' => 'email',
            'email' => ['required', Rule::unique('patients')->ignore($email, 'email')],
            'dob' => 'date',
            'marital_status' => 'numeric|max:2|nullable',
            'emergency_contact' => 'string|max:20|nullable|nullable',
            'emergency_contact_number' => 'numeric|digits:7|nullable',
            'drug_allergies' => 'string|max:20|nullable',
            'food_allergies' => 'string|max:20|nullable',
        ];
    }
}
