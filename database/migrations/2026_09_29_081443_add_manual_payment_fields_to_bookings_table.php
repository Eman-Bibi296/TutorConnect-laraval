<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('transaction_reference')->nullable()->after('payment_method');
            $table->string('payment_verification_status')->default('not_submitted')->after('transaction_reference');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'transaction_reference', 'payment_verification_status']);
        });
    }
};