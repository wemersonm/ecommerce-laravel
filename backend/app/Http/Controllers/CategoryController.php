<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        if (!Cache::has('categories')) {
            $categories = Category::all();
            Cache::forever('categories', json_encode($categories));
        }
        $categories = json_decode(Cache::get('categories'));
        return CategoriesResource::collection($categories);
    }
}
