<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'nid' => 'required|string|unique:users,nid|max:20',
            // 'address' => 'required|string|max:20',
            // 'island' => 'required|string|max:20',
            // 'atoll' => 'required|string|max:20',
            // 'city' => 'required|string|max:20',
            // 'country' => 'required|string|max:20',
            'phone_number' => 'required|max:7|numeric|unique:users,phone_number',
            'email' => 'required|email|unique:users,email',
            'dob' => 'required|date',
            'marital_status' => 'required|string',
            'specialty_id' => 'required|max:3',
            'registration_number' => 'required|string|max:20',
        ];
    }
}
