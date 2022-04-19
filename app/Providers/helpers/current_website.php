<?php

use App\Models\Website;

if (!function_exists('current_website')) {
    function current_website(): Website
    {
        return Website::getCurrentWebsite();
    }
}
