<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->text('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->string('availability')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->dropColumn(['profile_picture', 'bio', 'hourly_rate', 'availability']);
        });
    }
};