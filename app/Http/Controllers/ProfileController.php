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
        $userId = $this->username()->id; 
        
        return [
            // Kolom 'name' dan 'username'
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 
                'string', 
                'max:255', 
                // Memastikan username unik, kecuali untuk pengguna ini
                Rule::unique(User::class)->ignore($userId),
            ],
            
            // Kolom 'email'
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