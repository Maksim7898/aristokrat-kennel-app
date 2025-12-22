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
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('gender');
            $table->string('status');
            $table->text('character');
            $table->text('vaccination_info');
            $table->date('date_of_birth');
            $table->foreignId('cat_breed_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cat_class_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mother_id')->nullable()->constrained('cats')->nullOnDelete();
            $table->foreignId('father_id')->nullable()->constrained('cats')->nullOnDelete();
            $table->decimal('price', 15, 2);
            $table->timestamps();

            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};
