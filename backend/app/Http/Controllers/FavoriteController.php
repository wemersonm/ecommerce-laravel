<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct(
        private FavoriteService $favoriteService,
    ) {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        return $this->favoriteService->getAllFavorites();
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'numeric'],
        ]);
        return $this->favoriteService->addFavorite($data['id']);
    }

    public function destroy(Request $request)
    {

        $request_data = $request->validate(['id' => ['required', 'numeric']]);
        return $this->favoriteService->deleteFavorite($request_data['id']);

    }
}
