<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_meta_seos', function (Blueprint $table) {
            $table->id();
            // Home
            $table->text('home_title')->nullable();
            $table->text('home_description')->nullable();
            $table->text('home_keywords')->nullable();
            $table->enum('home_robots', ['index', 'follow'])->nullable();
            $table->string('home_canonical_url')->nullable();
            // About
            $table->text('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->text('about_keywords')->nullable();
            $table->enum('about_robots', ['index', 'follow'])->nullable();
            $table->string('about_canonical_url')->nullable();
            // Contact
            $table->text('contact_title')->nullable();
            $table->text('contact_description')->nullable();
            $table->text('contact_keywords')->nullable();
            $table->enum('contact_robots', ['index', 'follow'])->nullable();
            $table->string('contact_canonical_url')->nullable();
            // blog
            $table->text('blog_title')->nullable();
            $table->text('blog_description')->nullable();
            $table->text('blog_keywords')->nullable();
            $table->enum('blog_robots', ['index', 'follow'])->nullable();
            $table->string('blog_canonical_url')->nullable();
            // Privacy
            $table->text('privacy_title')->nullable();
            $table->text('privacy_description')->nullable();
            $table->text('privacy_keywords')->nullable();
            $table->enum('privacy_robots', ['index', 'follow'])->nullable();
            $table->string('privacy_canonical_url')->nullable();
            // faq
            $table->text('faq_title')->nullable();
            $table->text('faq_description')->nullable();
            $table->text('faq_keywords')->nullable();
            $table->enum('faq_robots', ['index', 'follow'])->nullable();
            $table->string('faq_canonical_url')->nullable();
            // Terms
            $table->text('terms_title')->nullable();
            $table->text('terms_description')->nullable();
            $table->text('terms_keywords')->nullable();
            $table->enum('terms_robots', ['index', 'follow'])->nullable();
            $table->string('terms_canonical_url')->nullable();
            // projects
            $table->text('project_title')->nullable();
            $table->text('project_description')->nullable();
            $table->text('project_keywords')->nullable();
            $table->enum('project_robots', ['index', 'follow'])->nullable();
            $table->string('project_canonical_url')->nullable();
            // Open Graph
            $table->string('author')->nullable();
            $table->string('language')->nullable();
            $table->string('revisit_after')->nullable();
            $table->string('theme_color')->nullable();
            $table->string('geo_region')->nullable();
            $table->string('geo_placename')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_site_name')->nullable();
            // Twitter
            $table->string('twitter_card')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_meta_seos');
    }
};
