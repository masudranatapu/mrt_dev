<?php

use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ContactUsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DatabaseBackupController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\PageMetaSeoController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\ProjectStatusController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\SystemController;
use App\Http\Controllers\Backend\TeamController;
use Illuminate\Support\Facades\Route;

// admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::middleware(['auth.admin'])->group(function () {
        // designation
        Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard'], function () {
            Route::get('/', [DashboardController::class, 'dashboard'])->name('index');
        });

        // project status
        Route::group(['as' => 'project-status.', 'prefix' => 'project-status'], function () {
            Route::get('/', [ProjectStatusController::class, 'index'])->name('index');
            Route::post('store', [ProjectStatusController::class, 'store'])->name('store');
            Route::get('edit/{id}', [ProjectStatusController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ProjectStatusController::class, 'update'])->name('update');
            Route::post('delete/{id}', [ProjectStatusController::class, 'destroy'])->name('delete');
            Route::post('bulk/destroy', [ProjectStatusController::class, 'bulkDestroy'])->name('bulk.delete');
        });
        // project
        Route::group(['as' => 'project.', 'prefix' => 'project'], function () {
            Route::get('/', [ProjectController::class, 'index'])->name('index');
            Route::get('create', [ProjectController::class, 'create'])->name('create');
            Route::post('store', [ProjectController::class, 'store'])->name('store');
            Route::get('show/{id}', [ProjectController::class, 'show'])->name('show');
            Route::get('edit/{id}', [ProjectController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ProjectController::class, 'update'])->name('update');
            Route::post('delete/{id}', [ProjectController::class, 'destroy'])->name('delete');
            Route::post('bulk/destroy', [ProjectController::class, 'bulkDestroy'])->name('bulk.delete');
            // others information
            Route::post('status/change', [ProjectController::class, 'statusChange'])->name('status.change');
            Route::post('follow/up/date', [ProjectController::class, 'followUpDate'])->name('followup.date');
            Route::get('export/data', [ProjectController::class, 'exportData'])->name('export.data');
        });
        // setting
        Route::group(['as' => 'setting.', 'prefix' => 'setting'], function () {
            Route::get('/', [SettingController::class, 'setting'])->name('index');
            Route::post('update', [SettingController::class, 'settingUpdate'])->name('update');
            Route::post('permission-update', [SettingController::class, 'permissionSetting'])->name('permission.update');
            Route::post('meta-update', [SettingController::class, 'metaSetting'])->name('meta.update');
            // credential
            Route::get('credential', [SettingController::class, 'credential'])->name('credential');
            Route::post('mail/update', [SettingController::class, 'mailSetting'])->name('mail.update');
            Route::post('pusher/update', [SettingController::class, 'pusherSetting'])->name('pusher.update');
            Route::post('send/test-mail', [SettingController::class, 'sendTestMail'])->name('send.test.mail');
            Route::post('sms/update', [SettingController::class, 'smsSetting'])->name('sms.update');
            Route::post('send/test-sms', [SettingController::class, 'sendTestSms'])->name('send.test.sms');
            Route::post('theme/mood', [SettingController::class, 'themeMood'])->name('theme.mood');
            Route::get('privacy-terms', [SettingController::class, 'privacyTerms'])->name('privacy.terms');
            Route::post('privacy-terms', [SettingController::class, 'privacyTermsUpdate'])->name('privacy.terms.update');
        });
        // system
        Route::group(['as' => 'system.', 'prefix' => 'system'], function () {
            Route::get('cache/clear', [SystemController::class, 'clearCache'])->name('cache.clear');
            Route::get('details', [SystemController::class, 'systemDetails'])->name('details');
        });
        // system
        Route::group(['as' => 'database-backup.', 'prefix' => 'database-backup'], function () {
            Route::get('/', [DatabaseBackupController::class, 'index'])->name('index');
            Route::get('create', [DatabaseBackupController::class, 'create'])->name('create');
            Route::post('delete/{id}', [DatabaseBackupController::class, 'destroy'])->name('delete');
        });
        // services
        Route::group(['as' => 'services.', 'prefix' => 'services'], function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::post('store', [ServiceController::class, 'store'])->name('store');
            Route::get('edit/{id}', [ServiceController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ServiceController::class, 'update'])->name('update');
            Route::post('delete/{id}', [ServiceController::class, 'destroy'])->name('delete');
            Route::post('bulk/destroy', [ServiceController::class, 'bulkDestroy'])->name('bulk.delete');
        });
        // others
        Route::group(['as' => 'others.', 'prefix' => 'others'], function () {
            Route::get('set/language/{lang}', [LanguageController::class, 'setLang'])->name('set.lang');
        });
        // page seo
        Route::group(['as' => 'page-seo.', 'prefix' => 'page-seo'], function () {
            Route::get('/', [PageMetaSeoController::class, 'index'])->name('index');
            Route::post('update', [PageMetaSeoController::class, 'update'])->name('update');
        });

        // faqs
        Route::group(['as' => 'faqs.', 'prefix' => 'faqs'], function () {
            Route::get('/', [FaqController::class, 'index'])->name('index');
            Route::post('store', [FaqController::class, 'store'])->name('store');
            Route::get('edit/{id}', [FaqController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [FaqController::class, 'update'])->name('update');
            Route::post('delete/{id}', [FaqController::class, 'destroy'])->name('delete');
            Route::post('bulk/destroy', [FaqController::class, 'bulkDestroy'])->name('bulk.delete');
        });
        // blogs
        Route::group(['as' => 'blogs.', 'prefix' => 'blogs'], function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('create', [BlogController::class, 'create'])->name('create');
            Route::post('store', [BlogController::class, 'store'])->name('store');
            Route::get('edit/{id}', [BlogController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [BlogController::class, 'update'])->name('update');
            Route::post('delete/{id}', [BlogController::class, 'destroy'])->name('delete');
            Route::post('bulk/destroy', [BlogController::class, 'bulkDestroy'])->name('bulk.delete');
        });

        // subscribers
        Route::group(['as' => 'subscribers.', 'prefix' => 'subscribers'], function () {
            Route::get('/', [SubscriberController::class, 'index'])->name('index');
            Route::post('delete/{id}', [SubscriberController::class, 'destroy'])->name('delete');
            Route::post('bulk/destroy', [SubscriberController::class, 'bulkDestroy'])->name('bulk.delete');
        });
        // contact
        Route::group(['as' => 'contact-us.', 'prefix' => 'contact-us'], function () {
            Route::get('/', [ContactUsController::class, 'index'])->name('index');
            Route::get('show/{id}', [ContactUsController::class, 'show'])->name('show');
            Route::post('delete/{id}', [ContactUsController::class, 'destroy'])->name('delete');
            Route::post('bulk/destroy', [ContactUsController::class, 'bulkDestroy'])->name('bulk.delete');
        });
        // team
        Route::group(['as' => 'team.', 'prefix' => 'team'], function () {
            Route::get('/', [TeamController::class, 'index'])->name('index');
            Route::post('store', [TeamController::class, 'store'])->name('store');
            Route::get('edit/{id}', [TeamController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [TeamController::class, 'update'])->name('update');
            Route::post('delete/{id}', [TeamController::class, 'destroy'])->name('delete');
            Route::post('bulk/destroy', [TeamController::class, 'bulkDestroy'])->name('bulk.delete');
        });
    });
});
