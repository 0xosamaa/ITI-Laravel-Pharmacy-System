<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Doctor;

class UpdateDoctorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $id = $this->input('id');
        $doctor = Doctor::find($id);

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$doctor->user_id],
            'national_id' => ['required', 'digits:14', 'unique:users,national_id,'.$doctor->user_id],
            'avatar_image' => ['nullable', 'image'],
            'pharmacy_id' => ['required', 'exists:pharmacies,id']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name must be at most 255 characters',
            'email.required' => 'Email is required',
            'email.max' => 'Email must be at most 255 characters',
            'email.unique' => 'Email already exists',
            'national_id.required' => 'National ID is required',
            'national_id.digits' => 'National ID must be a valid 14-digit number',
            'national_id.unique' => 'National ID already exists',
            'avatar_image.image' => 'Avatar must be an image',
            'pharmacy_id.required' => 'Pharmacy is required',
            'pharmacy_id.exists' => 'Pharmacy does not exist'
        ];
    }
}
