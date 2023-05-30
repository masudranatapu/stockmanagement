<?php 


 function currentLanguage()
{
    if (session()->has('set_lang')) {
        $lang = Language::where('code', session('set_lang'))->first();
    } else {
        $lang = Language::where('code', env('APP_DEFAULT_LANGUAGE'))->first();
    }

    return $lang;
}