<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function renderPage(Request $request, $slug)
    {
        /** @var PageContent */
        $page = PageContent::where('url', $slug)
            ->where('is_shown', 1)
            ->firstOrFail();

        return view('website.page_content', [
            'page' => $page,
        ]);
    }
}
