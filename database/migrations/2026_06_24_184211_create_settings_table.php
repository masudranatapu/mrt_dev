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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            // basic
            $table->string('site_title')->nullable();
            $table->string('site_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('site_currency')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('session_lifetime')->default(200)->nullable();
            $table->integer('session_expired')->default(5)->nullable();
            $table->string('site_timezone')->default('Asia/Dhaka')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('x_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->enum('default_lang', [GlobalConstantEnum::DEFAULT_LANGUAGE])->default(GlobalConstantEnum::DEFAULT_LANGUAGE[0])->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_condition')->nullable();
            // mail config
            $table->enum('mail_status', GlobalConstantEnum::STATUS)->nullable();
            $table->string('email_from_name')->nullable();
            $table->string('email_from_address')->nullable();
            $table->string('mailing_driver')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_secure')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            // pusher setup
            $table->enum('pusher_status', GlobalConstantEnum::STATUS)->nullable();
            $table->string('pusher_app_id')->nullable();
            $table->string('pusher_key')->nullable();
            $table->string('pusher_secret')->nullable();
            $table->string('pusher_cluster')->nullable();
            // status
            $table->enum('debug_mode', GlobalConstantEnum::YESNO)->default(GlobalConstantEnum::YESNO[0])->nullable();
            $table->enum('website_loading', GlobalConstantEnum::YESNO)->default(GlobalConstantEnum::YESNO[0])->nullable();
            $table->enum('theme_mood', GlobalConstantEnum::THEME_MOOD)->default(GlobalConstantEnum::THEME_MOOD[0])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
