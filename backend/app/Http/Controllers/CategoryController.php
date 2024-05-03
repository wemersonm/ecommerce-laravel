<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ResponseService;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\CategoriesResource;

class CategoryController extends Controller
{
    use ResponseService;
    public function index()
    {
        try {
            $categories = Cache::has('categories_cache') ?
                json_decode(Cache::get('categories_cache')) : null;

            if (!$categories) {
                $categories = Category::orderBy('name')->get();
            }
            return $this->responseSuccess(CategoriesResource::collection($categories));
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when get categories');
        }
    }
}
