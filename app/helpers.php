<?php

use App\Models\Category;
use App\Models\Conversation;
use App\Models\FrontCms;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\NotificationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;









/**
 * @return HigherOrderBuilderProxy|mixed
 */
function getCurrentLanguageName()
{
    static $language;

    if (!empty($language)) {
        return $language;
    }

    $language = 'english';

    return $language;
}
function get_default_language()
{
    $language = Language::where('default_language', 'on')->first();
    if ($language) {
        $iso_code = $language->iso_code;
        return $iso_code;
    }

    return 'en';
}
if (!function_exists('lang_path')) {
    /**
     * Get the path to the language folder.
     *
     * @param  string  $path
     * @return string
     */
    function lang_path($path = '')
    {
        return app()->langPath($path);
    }
}
function appLanguages()
{
    return Language::where('status', 1)->get();
}

function selectedLanguage($ln)
{
    $language = Language::where('iso_code', $ln)->first();
    if (!$language) {
        $language = Language::find(1);
        $ln = $language->iso_code;
    }

    session(['local' => $ln]);
    App::setLocale($ln);
    return $language;
}
function adminNotifications()
{
    return \App\Models\Notification::where('user_type', 1)->where('is_seen', 'no')->orderBy('created_at', 'DESC')->paginate(5);
}
function userNotifications()
{
    return  \App\Models\Notification::where('user_type', 2)
        ->where('is_seen', 'no')
        ->orderByDesc('created_at')
        ->paginate(5);

}
function toastrMessage($type, $message)
{
    Session::flash('toastr_message', [
        'type' => $type,
        'message' => $message
    ]);
}
if (!function_exists('str_slug')) {
    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string  $title
     * @param  string  $separator
     * @param  string  $language
     * @return string
     */
    function str_slug($title, $separator = '-', $language = 'en')
    {
        return Str::slug($title, $separator, $language);
    }
}
function get_option($option_key, $default = NULL)
{
    $system_settings = config('settings');

    if ($option_key && isset($system_settings[$option_key])) {
        return $system_settings[$option_key];
    } elseif ($option_key && isset($system_settings[strtolower($option_key)])) {
        return $system_settings[strtolower($option_key)];
    } elseif ($option_key && isset($system_settings[strtoupper($option_key)])) {
        return $system_settings[strtoupper($option_key)];
    } else {
        return $default;
    }
}
function getCategory()
{
    $category = Category::orderby('id', 'desc')->take(6)->get();
    return $category;
}
function unique_slug($title = '', $model = 'Campaign')
{
    $slug = str_slug($title);
    //get unique slug...
    $nSlug = $slug;
    $i = 0;

    $model = str_replace(' ', '', "\App\Models\ " . $model);
    while (($model::whereSlug($nSlug)->count()) > 0) {
        $i++;
        $nSlug = $slug . '-' . $i;
    }
    if ($i > 0) {
        $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
    } else {
        $newSlug = $slug;
    }

    return $newSlug;
}
/**
 * @return User
 */
function getLoggedInUser()
{
    $user_session = User::where('id', Session::get('LoggedIn'))->first();
    return $user_session;
}
if (!function_exists('getSlug')) {
    function getSlug($text)
    {
        if ($text) {
            $data = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $text);
            $slug = preg_replace("/[\/_|+ -]+/", "-", $data);
            return $slug;
        }
        return '';
    }
}


function isValidURL($url)
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

function getDefaultAvatar()
{
    return asset('assets/images/avatar.png');
}

/**
 * return random color.
 *
 * @param  int  $userId
 * @return string
 */
function getRandomColor($userId)
{
    $colors = ['329af0', 'fc6369', 'ffaa2e', '42c9af', '7d68f0'];
    $index = $userId % 5;

    return $colors[$index];
}

/**
 * return avatar url.
 *
 * @return string
 */
function getAvatarUrl()
{
    return 'https://ui-avatars.com/api/';
}

/**
 * return avatar full url.
 *
 * @param  int  $userId
 * @param  string  $name
 * @return string
 */
function getUserImageInitial($userId, $name)
{
    return getAvatarUrl() . "?name=$name&size=100&rounded=true&color=fff&background=" . getRandomColor($userId);
}


function getApplicationsettings()
{
    $general_setting = GeneralSetting::find('1');
    return $general_setting;
}
function getImageFile($file)
{
    if ($file != '') {
        return asset($file);
    } else {
        return asset('frontend/assets/img/no-image.png');
    }
}
