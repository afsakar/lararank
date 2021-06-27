<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

function is_active($url, $className = 'active')
{
    return request()->is(config('settings.prefix') . '/' . $url) ? $className : null;
}

function darkMode($value)
{
    if (date("H") < 6 || date("H") > 18) {
        $mode = array(
            "body" => "dark-mode",
            "navbar" => "navbar-dark sidebar-dark-primary",
            "modal-bg" => "modal-bg",
            "site" => "dark",
        );
    } else {
        $mode = [
            "body" => "",
            "navbar" => "navbar-light sidebar-light-primary",
            "modal-bg" => "modal-bg",
            "site" => "light",
        ];
    }
    return $mode[$value];
}

function set_active($route)
{

    if (is_array($route)) {
        return in_array(request()->path(), $route) ? 'current-menu-item' : '';
    }
    return request()->path() == $route ? 'current-menu-item' : '';

}

function getUrl()
{
    return request()->segment(1) ? request()->segment(1) : (request()->segment(0) ?? "/");
}

function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function profile_photo($name, $text_color = "7F9CF5", $bg_color = "EBF4FF")
{
    $text_color = str_replace('#', '', $text_color);
    $bg_color = str_replace('#', '', $bg_color);
    $name = str_replace(' ', '+', $name);
    return 'https://ui-avatars.com/api/?name=' . $name . '&color=' . $text_color . '&background=' . $bg_color . '';
}

function admin_asset($path = "")
{
    return asset('assets/admin/' . $path);
}

function permission_check($route, $action)
{
    $user = auth()->user();

    if ($user->role_id == 1) {
        return true;
    } else {
        if ($user->permissions != "null") {
            $permissions = json_decode($user->permissions, true);

            if (isset($permissions[$route][$action])) {
                return true;
            } else {
                return false;
            }
        } else {
            $perms = Role::where('id', $user->role_id)->first();

            $permissions = json_decode($perms->permissions, true);

            if (isset($permissions[$route][$action])) {
                return true;
            } else {
                return false;
            }
        }
    }

}

function send_notify($type, $title, $message)
{
    $options = array(
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'encrypted' => true
    );
    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        $options
    );

    $data = [
        'type' => $type,
        'title' => $title,
        'message' => $message
    ];

    $send = $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);

    if($send){

    }

}
