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
            $table->string('seat_name');//A1,A2,A3,A4,A11,A12
            $table->enum('seat_status',['available','full','defective']);
            $table->decimal('purchase_price')->nullable();
            $table->enum('discount', ['student','disabled','normal'])->nullable();
            $table->dateTime('purchase_date')->nullable();
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
