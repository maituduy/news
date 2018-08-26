<?php

use App\Category;
use App\Story;
use Carbon\Carbon;
use App\Tag;
use App\Comment;
use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $stories = Story::all();
    return view('client.bao', compact('stories'));
})->name('home');

Route::get('/login', 'User\AuthController@showLoginForm');
Route::post('/login', 'User\AuthController@login');
Route::get('/logout', 'User\AuthController@logout')->name('logout');

Route::get('/{slug}.{id}.htm', function($slug, $id) {
    $category = Category::findOrFail($id); 
    $stories = $category->stories()->orderBy('created_at', 'desc')->paginate(10);
    $cate_name = $category->name;
    return view('client.category', compact('stories', 'cate_name'));
})->name('category');

Route::get('/tag/{slug}.{id}.htm', function($slug, $id) {
    $tag = Tag::findOrFail($id); 
    $stories = $tag->stories()->orderBy('created_at', 'desc')->paginate(10);
    $tag_name = $tag->name;
    return view('client.tag', compact('stories', 'tag_name'));
})->name('tag');

Route::post('/comment/{id}', function(Request $request, $id) {
    if ($request->comment == null) {
        return redirect()->back();
    }
    $comment = new Comment();
    $comment->content = $request->comment;
    $comment->user()->associate(User::find(auth()->user()->id));
    Story::findOrFail($id)->comments()->save($comment);
    return redirect()->back();
})->name('comment');

Route::get('/{cate}/{slug}.{id}.htm', function($cate, $slug, $id) {
    $story = Story::findOrFail($id);
    $tags = $story->tags()->get();
    $tags_name = [];
    foreach($tags as $tag)
        array_push($tags_name, $tag->name);
    $related_news = Story::where('id', '!=', $id)->whereHas('tags', function($query) use ($tags_name) {
        $query->whereIn('name', $tags_name);
    })->orderBy('created_at', 'desc')->get();
    $story->addViewWithExpiryDate(Carbon::now()->addHours(2));

    $comments = $story->comments()->orderBy('likes', 'desc')->orderBy('created_at', 'desc')->get();
    return view('client.posted', compact('story', 'related_news', 'comments'));
})->name('story');

Route::prefix('/admin')->group(function () {
    Route::get('/', 'Admin\AuthController@showLoginForm');
    Route::post('/', 'Admin\AuthController@login');
    Route::get('/logout', 'Admin\AuthController@logout')->name('admin_logout');
    Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin_dashboard');

    Route::post('/users/destroymany', 'Admin\UserController@destroyMany')->name('users.destroymany');
    Route::get('/users/changestatus/{id}', 'Admin\UserController@changeStatus')->name('users.change');
    Route::resource('/users', 'Admin\UserController');

    Route::get('/categories', 'Admin\CategoryController@index')->name('categories.index');
    Route::post('/createcategory', 'Admin\CategoryController@ajax')->name('cateajax');

    Route::post('/employees/destroymany', 'Admin\EmployeeController@destroyMany')->name('employees.destroymany');
    Route::resource('employees', 'Admin\EmployeeController');
    
    Route::resource('/stories', 'Admin\StoryController');
});
