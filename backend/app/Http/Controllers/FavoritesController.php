<?php

namespace App\Http\Controllers;

use App\Services\FavoritesService;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct(
        private FavoritesService $favoritesService,
    ) {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        return $this->favoritesService->getAllProductFavorites();
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        return $this->favoritesService->toggleProductFavorites($data['id']);
    }
}
