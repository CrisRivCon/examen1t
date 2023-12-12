<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyecciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelicula_id')->constrained();
            $table->dateTime('fecha_hora');
            $table->foreignId('sala_id')->constrained();
            $table->timestamps();
            $table->unique(['pelicula_id', 'fecha_hora', 'sala_id']);
        });

        DB::table('proyecciones')->insert([
            [
                'pelicula_id' => 1,
                'fecha_hora' => Carbon::create(2023, 3, 2, 20, 30, 00, 'Europe/Madrid'),
                'sala_id' => 2
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecciones');
    }
};
