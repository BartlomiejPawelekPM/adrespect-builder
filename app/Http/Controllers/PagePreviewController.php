<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PagePreviewController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.preview', ['page' => $page]);
    }
}
