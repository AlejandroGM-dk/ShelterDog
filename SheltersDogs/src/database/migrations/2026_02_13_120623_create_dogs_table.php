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
        //
        Schema::create("dogs", function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->string('name');
            $table->string('breed');
            $table->date('birth_date');
            $table->enum('status', ['available', 'adopted'])->default('available');       
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("dogs");
    }
};
