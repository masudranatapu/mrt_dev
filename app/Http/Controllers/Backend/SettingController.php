<?php

namespace App\Http\Controllers\Backend;

use App\Classes\FileUploadClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Setting\BasicSettingRequest;
use App\Http\Requests\Backend\Setting\MailSettingRequest;
use App\Http\Requests\Backend\Setting\MetaSettingRequest;
use App\Http\Requests\Backend\Setting\PermissionSettingRequest;
use App\Http\Requests\Backend\Setting\PrivacyTermsRequest;
use App\Http\Requests\Backend\Setting\PusherSettingRequest;
use App\Http\Requests\Backend\Setting\TestMailRequest;
use App\Mail\SendTestMail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    protected $fileUpload;

    public function __construct(FileUploadClass $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    public function setting()
    {
        try {

            $setting = Setting::query()
                ->firstOrCreate();

            return view('backend.setting.index', compact('setting'));
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function settingUpdate(BasicSettingRequest $request)
    {

        try {
            DB::beginTransaction();

            $setting = Setting::query()
                ->first();

            $setting->site_title = $request->site_title;
            $setting->site_email = $request->site_email;
            $setting->phone = $request->phone;
            $setting->address = $request->address;
            $setting->copyright_text = $request->copyright_text;
            $setting->site_currency = $request->site_currency;
            $setting->currency_symbol = $request->currency_symbol;
            $setting->session_lifetime = $request->session_lifetime;
            $setting->session_expired = $request->session_expired;
            $setting->support_email = $request->support_email;
            $setting->backup_email = $request->backup_email;
            $setting->google_drive_folder_id = $request->google_drive_folder_id;
            $setting->site_timezone = $request->site_timezone;
            $setting->site_url_link = $request->site_url_link;
            $setting->default_checkin = $request->default_checkin;
            $setting->default_checkout = $request->default_checkout;

            if (isset($request->site_logo) && $request->hasFile("site_logo")) {
                $this->fileUpload->fileUnlink($setting->site_logo);
                $logo_url = $this->fileUpload->imageUploader($request->file('site_logo'), 'setting', 168, 39);
                $setting->site_logo = $logo_url;
            }

            if (isset($request->site_favicon) && $request->hasFile("site_favicon")) {
                $this->fileUpload->fileUnlink($setting->site_favicon);
                $favicon_url = $this->fileUpload->imageUploader($request->file('site_favicon'), 'setting', 64, 64);
                $setting->site_favicon = $favicon_url;
            }

            $setting->weekends = $request->weekends;
            $setting->youtube_link = $request->youtube_link;
            $setting->facebook_link = $request->facebook_link;
            $setting->x_link = $request->x_link;
            $setting->instagram_link = $request->instagram_link;
            $setting->linkedin_link = $request->linkedin_link;

            $setting->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Setting updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function credential()
    {
        try {

            $setting = Setting::query()
                ->firstOrCreate();

            return view('backend.setting.credential_setting', compact('setting'));
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function permissionSetting(PermissionSettingRequest $request)
    {
        try {
            DB::beginTransaction();

            $setting = Setting::query()
                ->first();

            $setting->email_verification = $request->email_verification;
            $setting->phone_verification = $request->phone_verification;
            $setting->otp_verification = $request->otp_verification;
            $setting->theme_mood = $request->theme_mood;
            $setting->mail_status = $request->mail_status;
            $setting->pusher_status = $request->pusher_status;
            $setting->debug_mode = $request->debug_mode;
            $setting->sms_status = $request->sms_status;
            $setting->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Setting updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function metaSetting(MetaSettingRequest $request)
    {
        try {

            DB::beginTransaction();

            $setting = Setting::query()
                ->first();

            $setting->meta_title = $request->meta_title;

            if (isset($request->meta_image) && $request->hasFile("meta_image")) {
                $this->fileUpload->fileUnlink($setting->meta_image);
                $favicon_url = $this->fileUpload->imageUploader($request->file('meta_image'), 'setting', 64, 64);
                $setting->meta_image = $favicon_url;
            }

            $setting->meta_keywords = $request->meta_keywords;
            $setting->meta_description = $request->meta_description;
            $setting->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Setting updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function mailSetting(MailSettingRequest $request)
    {

        try {
            DB::beginTransaction();

            $setting = Setting::query()
                ->first();

            $setting->mail_status = $request->mail_status;
            $setting->email_from_name = $request->email_from_name;
            $setting->email_from_address = $request->email_from_address;
            $setting->mailing_driver = $request->mailing_driver;
            $setting->mail_host = $request->mail_host;
            $setting->mail_port = $request->mail_port;
            $setting->mail_secure = $request->mail_secure;
            $setting->mail_username = $request->mail_username;
            $setting->mail_password = $request->mail_password;

            $setting->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Setting updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function pusherSetting(PusherSettingRequest $request)
    {
        try {
            DB::beginTransaction();

            $setting = Setting::query()
                ->first();

            $setting->pusher_app_id = $request->pusher_app_id;
            $setting->pusher_key = $request->pusher_key;
            $setting->pusher_secret = $request->pusher_secret;
            $setting->pusher_cluster = $request->pusher_cluster;
            $setting->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Setting updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function sendTestMail(TestMailRequest $request)
    {
        try {

            $details = [
                'title' => 'Test Mail',
                'body' => 'This is just an test mail'
            ];

            Mail::to($request->email)->send(new SendTestMail($details));

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Test email sent successfully. Please check your inbox',
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function themeMood(Request $request)
    {
        try {
            DB::beginTransaction();
            $setting = Setting::query()
                ->first();

            $setting->theme_mood = $request->theme_mood;
            $setting->save();

            DB::commit();

            return response()->json([
                'alert-type' => 'error',
                'message' => __("Theme change to $request->theme_mood Mood"),
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'alert-type' => 'error',
                'message' => 'Something went wrong. Please try again',
            ]);
        }
    }

    public function privacyTerms()
    {
        //
        try {
            $setting = Setting::query()
                ->firstOrCreate();

            return view('backend.setting.privacy_terms', compact('setting'));
        } catch (\Throwable $e) {

            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function privacyTermsUpdate(PrivacyTermsRequest $request)
    {
        //
        try {
            DB::beginTransaction();

            $setting = Setting::query()
                ->first();

            if ($request->type != 'terms') {
                $setting->privacy_policy = $request->privacy_policy;
            }

            $setting->terms_condition = $request->terms_condition;

            $setting->save();

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'Test SMS process completed.',
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}

