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
            $table->date('date'); // same as reservations
            $table->dateTime('time_start');
            $table->dateTime('time_finish');
            $table->string('floor');
            $table->dateTime('archived_at')->default(now()); // when moved to history
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
