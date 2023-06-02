<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('session_seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
             $table->string('seat_name');
            $table->boolean('seat_status');
            $table->dateTime('purchase_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_seats');
    }
};
