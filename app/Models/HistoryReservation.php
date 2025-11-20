<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryReservation extends Model
{
    use HasFactory;

    protected $table = 'history_reservations';

    protected $fillable = [
        'user_id',
        'reason_for_reservation',
        'date',
        'time_start',
        'time_finish',
        'floor',
        'archived_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
