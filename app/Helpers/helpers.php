<?php

use App\Mail\SendDatabaseBackupMail;
use App\Models\DatabaseBackup;
use App\Models\LoginTimeTracker;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

if (!function_exists("authAdmin")) {
    function authAdmin()
    {
        return Auth::guard('admin')->user();
    }
}

if (!function_exists("authCustomer")) {
    function authCustomer()
    {
        return Auth::guard("customer")->user();
    }
}

if (!function_exists("authExistId")) {
    function authExistId()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard("admin")->user()->id;
        } else {
            return null;
        }
    }
}

if (!function_exists('siteSettings')) {
    function siteSettings()
    {
        $setting = Setting::query()
            ->firstOrCreate();

        return $setting;
    }
}

if (!function_exists('loginLogoutTimeTracker')) {

    function loginLogoutTimeTracker($loginType, $userId)
    {
        $loginTimeTracker = new LoginTimeTracker();
        $loginTimeTracker->user_id = $userId;
        $loginTimeTracker->ip_address = request()->ip();
        $loginTimeTracker->date_time = date('Y-m-d H:i:s');
        $loginTimeTracker->type = $loginType;
        $loginTimeTracker->save();
        return true;
    }
}

if (!function_exists('statusActiveClass')) {
    function statusActiveClass($status)
    {
        $map = [
            // General Status
            'Active' => 'bg-success',
            'Approved' => 'bg-success',
            'Inactive' => 'bg-secondary',
            'Blocked' => 'bg-danger',
            'Pending' => 'bg-warning',
            'Rejected' => 'bg-danger',
            // Draft / Process
            'Draft' => 'bg-info',
            'Drafted' => 'bg-info',
            'Processing' => 'bg-info',
            'Processed' => 'bg-info',
            // Boolean Type
            'Yes' => 'bg-success',
            'No' => 'bg-danger',
            // Job Type
            'Full Time' => 'bg-primary',
            'Part Time' => 'bg-warning',
            'Contract Based/ Freelance' => 'bg-info',
            // Work Type
            'Remote' => 'bg-success',
            'Hybrid' => 'bg-secondary',
            'Office Job/ Desk /On Site' => 'bg-dark',
            // Order / Payment
            'Confirmed' => 'bg-primary',
            'Delivery' => 'bg-success',
            'Cancelled' => 'bg-danger',
            'Paid' => 'bg-success',
            'Unpaid' => 'bg-danger',
        ];
        return $map[$status] ?? 'bg-secondary';
    }
}

if (!function_exists('limit')) {
    function limit($parPage)
    {
        $perPageValue = 20;

        if ($parPage) {
            $perPageValue = $parPage;
        }

        return $perPageValue;
    }
}

if (!function_exists('getUserIpAddress')) {
    function getIpAddress()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

if (!function_exists('phoneNumberFormate')) {
    function phoneNumberFormate($phone)
    {
        // Remove all non-numeric characters except '+'
        $phone = preg_replace('/[^0-9+]/', '', $phone);

        // 'p:+' and remove it
        if (Str::startsWith($phone, 'p:+')) {
            $phone = substr($phone, 3);
        }

        // '+880' and remove it
        if (Str::startsWith($phone, '+880')) {
            $phone = substr($phone, 4);
        }

        if (Str::startsWith($phone, '+88')) {
            $phone = substr($phone, 3);
        }

        if (Str::startsWith($phone, '880')) {
            $phone = substr($phone, 3);
        }

        // If the number still starts '0', do not removed, it completely
        if (!Str::startsWith($phone, '0')) {
            $phone = '0' . ltrim($phone, '0');
        }

        return $phone;
    }
}

if (!function_exists('imageDemoUserPath')) {
    function imageDemoUserPath($image)
    {
        $imageUrl = '';
        if ($image && file_exists($image)) {
            $imageUrl = asset($image);
        } else {
            $imageUrl = asset('default/demo_user.png');
        }

        return $imageUrl;
    }
}

if (!function_exists('imageDemoPath')) {
    function imageDemoPath($image)
    {
        $imageUrl = '';
        if ($image && file_exists($image)) {
            $imageUrl = asset($image);
        } else {
            $imageUrl = asset('default/demo_image.jpg');
        }

        return $imageUrl;
    }
}

if (!function_exists('formatImagePath')) {

    function formatImagePath($id, $imagePath)
    {
        if ($id && $imagePath) {
            return [
                [
                    'id' => $id,
                    'src' => asset($imagePath),
                ]
            ];
        }

        return [];
    }
}



if (!function_exists('siteLanguage')) {

    function siteLanguage()
    {
        if (Session::has('lang')) {
            App::setLocale(Session::get('lang'));
        }

        return App::getLocale() == 'ar' ? 'rtl' : 'ltr';
    }
}


if (!function_exists('exportDatabaseAsSql')) {
    function exportDatabaseAsSql()
    {
        $date = date('Y-m-d-H-i-s');

        $fileName = strtolower(str_replace(' ', '', siteSettings()->site_title)) . '-database-' . $date . '.sql';

        $path = public_path('storage/backups');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // for local

        $mysqldumpPath = 'C:\wamp64\bin\mysql\mysql9.1.0\bin\mysqldump.exe';

        // Database connection values
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');

        $filePath = $path . DIRECTORY_SEPARATOR . $fileName;

        $passwordOption = $dbPass !== '' ? "--password={$dbPass}" : "--password=\"\"";

        $command = "\"{$mysqldumpPath}\" --user={$dbUser} {$passwordOption} --host={$dbHost} {$dbName} --result-file=\"{$filePath}\" 2>&1";

        $output = null;
        $returnVar = null;

        exec($command, $output, $returnVar);

        // for live

        // $command = 'mysqldump --user=' . env('DB_USERNAME') . ' --password=' . env('DB_PASSWORD') . ' --host=' . env('DB_HOST') . ' ' . env('DB_DATABASE') . ' > ' . $path . '/' . $fileName;
        // $returnVar = NULL;
        // $output = NULL;
        // exec($command, $output, $returnVar);

        if ($returnVar == 0 && file_exists($filePath)) {

            $zipPath = makeZipArchive($filePath);

            $databaseBackup = new DatabaseBackup();
            $databaseBackup->date_time = date('Y-m-d H:i:s');
            $databaseBackup->title = siteSettings()->site_title . ' database backup ' . $date;
            $databaseBackup->file = 'storage/backups/' . basename($zipPath);
            $databaseBackup->file_size = formatSizeUnits(filesize($zipPath));
            $databaseBackup->download_link = url('storage/backups/' . basename($zipPath));
            $databaseBackup->created_by = authAdmin()->id;
            $databaseBackup->save();

            return $databaseBackup;
        }

        throw new \Exception('Backup failed. Command: ' . $command . ' Output: ' . implode("\n", $output));
    }
}

if (!function_exists('makeZipArchive')) {
    function makeZipArchive($file)
    {
        $zip = new ZipArchive();
        $zipPath = $file . '.zip';
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFile($file, basename($file));
        $zip->close();

        // after unlink the file
        unlink($file);

        return $zipPath;
    }
}

if (!function_exists('formatSizeUnits')) {
    function formatSizeUnits($bytes)
    {

        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

if (!function_exists('databaseBackupEmail')) {
    function databaseBackupEmail()
    {
        $backup = DatabaseBackup::query()
            ->latest()
            ->first();

        if (!$backup) {
            return false;
        }

        $recipientEmail = siteSettings()->backup_email ?? 'your-backup@email.com';

        try {
            $googleDrive = new GoogleDriveService();

            $driveLink = $googleDrive->upload(asset($backup->file), $backup->title);

            $details = [
                'name' => "Hi",
                'action' => $driveLink,
            ];

            Mail::to($recipientEmail)->send(new SendDatabaseBackupMail($details));

            $backup->drive_link = $driveLink;
            $backup->email_sent = 'Yes';
            $backup->save();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


if (!function_exists('timezones')) {
    function timezones()
    {
        $path = public_path('json/timeZone.json');

        if (file_exists($path)) {
            return json_decode(file_get_contents($path), true);
        }

        return [];
    }
}


if (!function_exists("weekDays")) {
    function weekDays()
    {
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return $days;
    }
}
