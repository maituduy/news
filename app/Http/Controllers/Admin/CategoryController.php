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
        $validator = Validator::make($request->all() ,[
            'name' => 'required|max:255|unique:categories'
        ]);
        if (!$validator->fails())
            Category::create(['name' => $request->name]);
        return response($validator->errors()->first());
    }

}
