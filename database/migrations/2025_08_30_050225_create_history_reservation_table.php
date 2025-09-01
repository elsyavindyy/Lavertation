<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // foreign key
            $table->string('reason_for_reservation');
            $table->date('reservation_date'); // same as reservations
            $table->timestamp('time_start');
            $table->timestamp('time_finish');
            $table->string('floor');
            $table->timestamp('archived_at')->useCurrent(); // when moved to history
            $table->timestamps(); // created_at & updated_at

            // Foreign key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_reservations');
    }
};
