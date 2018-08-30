<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function ajax(Request $request) {
        $category = new Category();
        $category->name = $request->category;
        $category->save();
        return response($category->id);
    }

}
