<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_categories', function (Blueprint $table) {
            $table->id();
            // Membuat foreign key untuk user_id yang terhubung ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Membuat foreign key untuk category_id yang terhubung ke tabel categories
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_categories');
    }
};