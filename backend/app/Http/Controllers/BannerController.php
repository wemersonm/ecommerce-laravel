<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'section' => ['regex:/^[a-zA-Z0-1\-]+$/'],
        ]);

        $banners = Banner::where('active', true)
            ->where('section', $request->input('section'))
            ->orderBy('order', 'asc')->get();
        return $banners;
    }
}
