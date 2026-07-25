<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Messages table mein is_read column
        Schema::table('messages', function (Blueprint $table) {
            $table->boolean('is_read')->default(0)->after('message');
        });
        
        // Requests table mein is_viewed column
        Schema::table('requests', function (Blueprint $table) {
            $table->boolean('is_viewed')->default(0)->after('status');
        });
        
        // Bookings table mein is_viewed column
        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('is_viewed')->default(0)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('is_read');
        });
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('is_viewed');
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('is_viewed');
        });
    }
};