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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            
            $table->foreignId('id_pulau')
            ->constrained('pulau_blog')
            ->cascadeOnDelete();

            $table->string('title');
            $table->string('location');
            $table->string('image')->nullable();
            $table->text('content')->nullable();
            $table->string('best_time_visit')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->text('tips')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};