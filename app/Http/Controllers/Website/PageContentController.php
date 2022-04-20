<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function renderPage(Request $request, $slug)
    {
        $page = PageContent::findBySlugOrFail($slug);

        return view('website.page_content', [
            'page' => $page,
        ]);
    }
}
