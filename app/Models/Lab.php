<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'name',
        'floor',
        'capacity',
    ];

    // Relasi: 1 lab punya banyak reservasi
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
