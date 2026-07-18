<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class PrivatePublicKeyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {

            if (Schema::hasTable('settings')) {
                $settings = Setting::firstOrCreate();
                // Set application timezone
                config()->set('app.timezone', $settings->site_timezone ?? 'UTC');
                // mail
                if ($settings->mail_status === 'Active') {

                    config()->set('mail.default', 'smtp');

                    config()->set('mail.mailers.smtp.host', $settings->mail_host);
                    config()->set('mail.mailers.smtp.port', $settings->mail_port);
                    config()->set('mail.mailers.smtp.encryption', $settings->mail_secure);
                    config()->set('mail.mailers.smtp.username', $settings->mail_username);
                    config()->set('mail.mailers.smtp.password', $settings->mail_password);

                    config()->set('mail.from.address', $settings->email_from_address);
                    config()->set('mail.from.name', $settings->email_from_name);
                }

                // cache clear
                Artisan::call('cache:clear');
            }
        } catch (\Exception $e) {
            // Log error or handle gracefully
            Log::error('Database connection error: ' . $e->getMessage());
        }
    }
}
