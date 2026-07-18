<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLang($lang)
    {
        try {

            $availableLangs = ['en', 'bn', 'ar'];

            if (in_array($lang, $availableLangs)) {
                Session::put('lang', $lang);
                App::setLocale($lang);
            }

            return redirect()->back();

        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
