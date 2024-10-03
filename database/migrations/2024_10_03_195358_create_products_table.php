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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID auto incremental
            $table->string('nombre'); // Nombre del producto
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->decimal('precio', 8, 2); // Precio con dos decimales
            $table->integer('stock'); // Cantidad en stock
            $table->tinyInteger('estado')->default(1); // Estado: 1 activo, 0 inactivo,
            $table->timestamps(); // Timestamps automáticos para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
