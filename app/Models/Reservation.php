<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi.
     */
    protected $fillable = [
        'user_id',
        'reason_for_reservation',
        'reservation_date',
        'time_start',
        'time_finish',
        'floor',
        'status',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'reservation_date' => 'date',
        'time_start' => 'datetime',
        'time_finish' => 'datetime',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}