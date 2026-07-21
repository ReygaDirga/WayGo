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
        Schema::create('itinerary_lists', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('day');
            $table->date('date');
            $table->string('time');
            $table->unsignedInteger('adults');
            $table->unsignedInteger('children');
            $table->string('destination_name');
            $table->text('address');
            $table->decimal('estimated_cost', 12, 2);
            $table->decimal('rating', 2, 1);
            $table->text('description')->nullable();
            $table->string('distance_to_next')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_lists');
    }
};