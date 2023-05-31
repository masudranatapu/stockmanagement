<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Artisan;

class HomeController extends Controller
{
    public function welcome()
    {
        $title = "Home";
        return view('welcome', compact('title'));
    }
    
    public function changeLanguage($lang)
    {
        session()->put('set_lang', $lang);
        app()->setLocale($lang);

        return back();

    }

}
