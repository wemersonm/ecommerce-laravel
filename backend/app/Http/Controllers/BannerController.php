<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Banner;
use App\Rules\SectionBanner;
use Illuminate\Http\Request;
use App\Traits\ResponseService;
use Illuminate\Support\Facades\Cache;

class BannerController extends Controller
{
    use ResponseService;
    public function index(Request $request)
    {
        $request_data = $request->validate([
            'section' => [new SectionBanner,],
        ]);
        try {
            $banners_cache = json_decode(Cache::get('banners_cache'), true);
            if ($banners_cache) {
                $banners_section = $banners_cache[$request_data['section']];
            }
            if (!isset($banners_section) || !$banners_section) {
                $banners_section = Banner::where('active', true)
                    ->where('section', $request_data['section'])
                    ->orderBy('order', 'asc')->get();
            }
            return $this->responseSuccess($banners_section);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when get banners');
        }
    }
}
