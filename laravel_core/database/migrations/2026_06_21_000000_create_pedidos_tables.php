<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->string('codigo', 20)->unique();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('envio', 12, 2)->default(0);
            $table->decimal('total', 12, 2);
            $table->string('estado', 30)->default('confirmado');
            $table->timestamps();
            $table->index('usuario_id');
        });

        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete();
            $table->unsignedBigInteger('producto_id');
            $table->string('nombre_producto');
            $table->string('imagen_producto')->nullable();
            $table->decimal('precio_unitario', 12, 2);
            $table->unsignedInteger('cantidad');
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
        Schema::dropIfExists('pedidos');
    }
};
