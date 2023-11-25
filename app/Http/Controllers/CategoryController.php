<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
* @OA\Get(
*   path = "/api/categories",
*   summary = "Get 10 popular category",
*   tags = {"Registration"},
*   @OA\Response(
*       response=200,
*       description="Success",
*       @OA\JsonContent(
*           type="array",
*           description="List of 10 categories",
*           @OA\Items( ref="#/components/schemas/Category" ),
*       )
*   ),
* )
*/

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::withCount('users')->orderByDesc('users_count')->limit(10)->get();

        return response()->json($categories);
    }
}
