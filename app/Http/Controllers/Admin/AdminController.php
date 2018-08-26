<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function dashboard() {
        $count_stories = json_encode(getStoriesLast7Days());
        $count_views = json_encode(getAllViewsLast7Days());
        return view('admin.dashboard', compact('count_stories', 'count_views'));
    }

}
