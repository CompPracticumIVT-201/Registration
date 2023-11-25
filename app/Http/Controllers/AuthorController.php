<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

/**
* @OA\Get(
*   path = "/api/authors",
*   summary = "Get 10 popular authors",
*   tags = {"Registration"},
*   @OA\Response(
*       response=200,
*       description="Success",
*       @OA\JsonContent(
*           type="array",
*           description="List of 10 authors",
*           @OA\Items( ref="#/components/schemas/Author" ),
*       )
*   ),
* )
*/

class AuthorController extends Controller
{
    public function index() {
        $popularAuthors = Author::withCount('users')->orderByDesc('users_count')->limit(10)->get();

        return response()->json($popularAuthors);
    }
}
