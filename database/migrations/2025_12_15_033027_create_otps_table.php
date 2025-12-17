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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();

            // where the OTP was sent
            $table->string('identifier'); // email or phone

            // hashed OTP (never store plain)
            $table->string('code_hash');

            // purpose (login now; later you can add "register", "reset", etc.)
            $table->string('purpose')->default('login');

            $table->timestamp('expires_at');
            $table->timestamp('consumed_at')->nullable();

            // anti-abuse / audit
            $table->unsignedInteger('attempts')->default(0);
            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamps();

            $table->index(['identifier', 'purpose']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
