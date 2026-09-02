<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'student_viewed')) {
                $table->boolean('student_viewed')->default(1);
            }
            if (!Schema::hasColumn('bookings', 'tutor_confirmed')) {
                $table->boolean('tutor_confirmed')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'tutor_confirmed')) {
                $table->dropColumn('tutor_confirmed');
            }
            if (Schema::hasColumn('bookings', 'student_viewed')) {
                $table->dropColumn('student_viewed');
            }
        });
    }
};