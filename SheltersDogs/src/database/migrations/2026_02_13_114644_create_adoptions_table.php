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
        Schema::create('adoptions', function (Blueprint $table) {
            $table ->id();
            $table->foreignId('dog_id')->constrained('dogs')->onDelete('cascade');
            $table->foreignId('adopter_id')->constrained('adopters')->onDelete('cascade');
            $table->date('adoption_date');
            $table->decimal('fee_paid', 10, 2);
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('adoptions');

    }
};
