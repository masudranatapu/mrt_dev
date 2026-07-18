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
        Schema::create('project_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('color')->nullable();
            $table->enum('status', GlobalConstantEnum::STATUS)->nullable()->nullable();
            $table->enum('send_sms', GlobalConstantEnum::YESNO)->nullable()->nullable();
            $table->text('sms_body')->nullable();
            $table->enum('send_email', GlobalConstantEnum::YESNO)->nullable()->nullable();
            $table->text('email_body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_statuses');
    }
};
