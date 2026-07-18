<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    public function clearCache()
    {
        try {

            Artisan::call('optimize:clear');
            // Artisan::call('optimize');
            // Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message' => 'System cache successfully clear.',
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function systemDetails()
    {
        try {
            $getPdoInfo = DB::connection()->getPdo();

            $version = $getPdoInfo->query('select version()')->fetchColumn();

            preg_match("/^[0-9\.]+/", $version, $match);

            $mySqlVersion = $match[0];

            $required_extensions = ['bcmath', 'ctype', 'json', 'mbstring', 'zip', 'zlib', 'openssl', 'pcre', 'filter', 'hash', 'session', 'tokenizer', 'xml', 'dom', 'curl', 'fileinfo', 'gd', 'pdo_mysql'];

            return view('backend.system.index', compact('required_extensions', 'mySqlVersion'));
        } catch (\Throwable $e) {

            return redirect()->back()->with([
                'message' => 'Something went wrong. Please try again',
                'alert-type' => 'error'
            ]);
        }
    }

}

