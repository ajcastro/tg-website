<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\GuideList;
use App\Models\Website;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index(Request $request)
    {
        $categories = GuideList::onlyActive()->distinct('category')->pluck('category');
        $activeCategory = $request->category ?? $categories->first();

        $guides = GuideList::onlyActive()
            ->eagerLoadGuideContentForWebsite(Website::getWebsiteId())
            ->where('category', $activeCategory)
            ->get();

        return view('website.help', [
            'guides' => $guides,
            'categories' => $categories,
            'activeCategory' => $activeCategory,
        ]);
    }
}
