<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKaryawanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:225',
            'email'         => 'required|email',
            'password'      => 'nullable|min:8',
            'jabatan'       => 'required|string|max:255',
            'gaji_pokok'    => 'required|numeric'
        ];
    }

    // custome message
    public function messages(): array
    {
        return [
            'name.required'         => 'Nama wajib diisi',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Format email tidak valid',
            'email.unique'          => 'Email telah terdaftar',
            'password.min'          => 'Pasword minimal 8 karakter',
            'jabatan.required'      => 'Jabatan wajib diisi',
            'gaji_pokok.required'   => 'Gaji pokok wajib diisi',
        ];
    }
}
