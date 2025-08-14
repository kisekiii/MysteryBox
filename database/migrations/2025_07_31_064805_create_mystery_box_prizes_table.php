<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mystery_box_prizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'mystery_box_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('hadiah');
            $table->string('image')->nullable();
            $table->integer('order_position')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mystery_box_prizes');
    }
};
