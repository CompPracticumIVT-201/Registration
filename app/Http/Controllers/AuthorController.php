<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $popularAuthors = Author::withCount('users')->orderByDesc('users_count')->limit(10)->get();

        return response()->json($popularAuthors);
    }
}
