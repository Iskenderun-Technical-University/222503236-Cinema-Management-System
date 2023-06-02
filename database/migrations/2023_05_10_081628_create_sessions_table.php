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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cinema_id');
            $table->foreign('cinema_id')->references('id')->on('cinemas');
            $table->unsignedBigInteger('movie_id');
            $table->foreign('movie_id')->references('id')->on('movies');
            //$table->foreignId('cinema_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            //$table->foreignId('movie_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // burada constrait kelimesi field isminda belirtilen alttirenin solundaki kismi tablo ismi olarak almamizi
            // sagindaki kismi ise field olarak almamizi saglar
            $table->date('date');
            $table->time('time');
            $table->decimal('price', 10, 2, false);// 10 rakam 2 ondalik ve pozitif degerler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
