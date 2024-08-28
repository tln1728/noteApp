<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die;
}
function pd($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    // die;
}

function isUrl($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function urlContain($value)
{
    return str_contains($_SERVER['REQUEST_URI'], $value);
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition)
{
    if (!$condition) abort(Response::FORBIDDEN);

    return true;
}

function base_path($path)
{
    // echo BASE_PATH . $path . '<br>';
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}

function login($user)
{
    $_SESSION['user'] = [
        'email' => $user['email']
    ];
    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];

    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}