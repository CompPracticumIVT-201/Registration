<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::withCount('users')->orderByDesc('users_count')->limit(10)->get();

        return response()->json($categories);
    }
}
