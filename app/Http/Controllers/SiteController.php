<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(): View
    {
            $page = Page::with([
                'pageMetas',
                'pageFiles',
            ])
            ->where('slug', 'home')
            ->first();

        return view('index', ['page' => $page]);
    }

}
