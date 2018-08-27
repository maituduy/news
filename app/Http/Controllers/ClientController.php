<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Story;
use Carbon\Carbon;
use App\Tag;
use App\Comment;
use App\User;
use App\Like;

class ClientController extends Controller
{
    //
    public function home() {
        $stories = Story::all();
        return view('client.bao', compact('stories'));
    }

    public function category($slug, $id) {
        $category = Category::findOrFail($id); 
        $stories = $category->stories()->orderBy('created_at', 'desc')->paginate(10);
        $cate_name = $category->name;
        $cate_id = $category->id;
        return view('client.category', compact('stories', 'cate_name', 'cate_id'));
    }

    public function tag($slug, $id){
        $tag = Tag::findOrFail($id); 
        $stories = $tag->stories()->orderBy('created_at', 'desc')->paginate(10);
        $tag_name = $tag->name;
        return view('client.tag', compact('stories', 'tag_name'));
    }

    public function ajax_like(Request $request) {
        $comment = Comment::findOrFail($request->id);
        if (!checkLikeAuthUser($comment)) {
            $like = new Like();
            $like->user()->associate(auth()->user());
            $like->comment()->associate($comment);
            $like->save();
            return 'liked';
        }
        else {
            Like::where('comment_id', $request->id)
                ->where('user_id', auth()->user()->id)
                ->delete();
            return 'unliked';
        }
    }

    public function comment(Request $request, $id) {
        if ($request->comment == null) {
            return redirect()->back();
        }
        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->user()->associate(User::find(auth()->user()->id));
        Story::findOrFail($id)->comments()->save($comment);
        return redirect()->back();
    }

    public function story($cate, $slug, $id) {
        $story = Story::findOrFail($id);
        $tags = $story->tags()->get();
        $tags_name = [];
        foreach($tags as $tag)
            array_push($tags_name, $tag->name);
        $related_news = Story::where('id', '!=', $id)->whereHas('tags', function($query) use ($tags_name) {
            $query->whereIn('name', $tags_name);
        })->orderBy('created_at', 'desc')->get();
        $story->addViewWithExpiryDate(Carbon::now()->addHours(2));

        $comments = Comment::where('story_id', $id)
                           ->withCount('likes')
                           ->orderBy('likes_count', 'desc')
                           ->paginate(10);
        
        return view('client.posted', compact('story', 'related_news', 'comments'));
    }

    public function search(Request $request) {
        $search = preg_replace('/\s+/', ' ', $request->search);
        $slug_search = slug($search);
        $stories = Story::whereHas('tags', function($query) use($search) {
                            $query->where('name', 'LIKE', "%$search%");
                        })
                        ->orWhere('slug', 'LIKE', "%$slug_search%")
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        return view('client.search', compact('stories', 'search'));
    }
}
