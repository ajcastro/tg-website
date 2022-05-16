<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class Game4dController extends Controller
{
    public function index()
    {
        $page = new PageContent([
            'short_description' => '4D Game',
        ]);
        $page->registerSeoTags();

        return view('website.game4d', [
            'page' => $page,
        ]);
    }
}
