<?php

use App\Models\User;
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
        Schema::create('database_backups', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time')->nullable();
            $table->string('title')->nullable();
            $table->string('file')->nullable();
            $table->string('file_size')->nullable();
            $table->string('download_link')->nullable();
            $table->string('drive_link')->nullable();
            $table->enum('email_sent', GlobalConstantEnum::YESNO)->nullable();
            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('database_backups');
    }
};
