<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PageContent;

class IndexController extends Controller
{
    public function index ()
    {
        $page = PageContent::findBySlug('/') ?? new PageContent();
        $page->registerSeoTags();

        return view('website.landing', [
            'page' => $page
        ]);
    }
}
