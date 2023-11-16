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
            $table->id();
            $table->string('code');
            $table->string('thumbnail');
            $table->string('brand');
            $table->string('name');
            $table->double('price');
            $table->double('discount');
            $table->integer('amount');
            $table->string('describe');
            $table->string('color');
            $table->string('origin');
            $table->bigInteger('max_amount');
            $table->timestamps();
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
