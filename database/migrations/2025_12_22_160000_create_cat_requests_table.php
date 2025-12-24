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
        Schema::create('cat_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cat_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('status');
            $table->text('purpose');
            $table->text('manager_note')->nullable();
            $table->decimal('amount', 15, 2);
            $table->boolean('is_paid')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'cat_id']);
            $table->unique(['user_id', 'cat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_requests');
    }
};
