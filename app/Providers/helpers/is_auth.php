<?php

if (!function_exists('is_auth')) {
    function is_auth()
    {
        return cache('is_auth');
    }
}

if (!function_exists('is_guest')) {
    function is_guest()
    {
        return !is_auth();
    }
}
