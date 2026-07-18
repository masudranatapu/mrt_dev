<?php

use App\Utils\GlobalConstantEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('unknown')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('country')->nullable();
            $table->json('language')->nullable();
            $table->string('signature')->nullable();
            $table->string('cv')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('nid_front')->nullable();
            $table->string('nid_back')->nullable();
            $table->enum('gender', GlobalConstantEnum::GENDER)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('emergency_contact_person_name')->nullable();
            $table->string('emergency_contact_person_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('bio')->nullable();
            $table->string('reset_password_token')->nullable();
            $table->enum('status', GlobalConstantEnum::USER_STATUS)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
