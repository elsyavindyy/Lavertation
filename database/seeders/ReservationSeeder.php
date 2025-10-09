<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'user_id' => 1,
                'reason_for_reservation' => 'Praktikum jaringan komputer',
                'reservation_date' => '2025-10-10',
                'time_start' => '2025-10-10 08:00:00',
                'time_finish' => '2025-10-10 10:00:00',
                'floor' => 'Lantai 1',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'reason_for_reservation' => 'Presentasi proyek akhir',
                'reservation_date' => '2025-10-11',
                'time_start' => '2025-10-11 10:00:00',
                'time_finish' => '2025-10-11 12:00:00',
                'floor' => 'Lantai 2',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'reason_for_reservation' => 'Kegiatan lomba robotik',
                'reservation_date' => '2025-10-12',
                'time_start' => '2025-10-12 13:00:00',
                'time_finish' => '2025-10-12 15:00:00',
                'floor' => 'Lantai 3',
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
