<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Mendapatkan ID pengguna yang sedang login untuk mengabaikan dirinya sendiri
        $userId = $this->user()->id; 
        
        return [
            // 1. Validasi Kolom 'name' (Nama Lengkap)
            'name' => ['required', 'string', 'max:255'],
            
            // 2. Validasi Kolom 'username' (PENTING: Pastikan ini ada di tabel 'users')
            'username' => [
                'required', 
                'string', 
                'max:255', 
                // Memastikan username unik, kecuali untuk pengguna ini
                Rule::unique(User::class)->ignore($userId),
            ],
            
            // 3. Validasi Kolom 'email'
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // Memastikan email unik, kecuali untuk pengguna ini
                Rule::unique(User::class)->ignore($userId),
            ],
        ];
    }
}