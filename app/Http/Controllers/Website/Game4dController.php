<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class Game4dController extends Controller
{
    public function index()
    {
        return view('website.game4d', [
            'page' => new PageContent()
        ]);
    }
}
