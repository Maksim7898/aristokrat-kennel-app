<?php

use App\Enums\UserRoleEnum;
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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'full_name');

            $table->string('phone');
            $table->string('city');
            $table->string('role')->default(UserRoleEnum::USER->value);
            $table->text('pet_experience');
            $table->text('living_conditions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('full_name', 'name');

            $table->dropColumn([
                'phone',
                'city',
                'role',
                'pet_experience',
                'living_conditions',
            ]);
        });
    }
};
