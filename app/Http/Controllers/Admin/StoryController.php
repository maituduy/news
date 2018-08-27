<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Story;
use App\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stories = Story::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.post.index', compact('stories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all() ,[
            'title' => 'required|unique:stories|max:255',
            'content' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:1024'
        ]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            if ($request->file('image')->isValid()) {
                // File này có thực, bắt đầu đổi tên và move
                $fileName = upload_file_to_story($request);
                
                fill_field_story($request, $fileName);
                return redirect()->route('stories.index');
            }
            else return redirect()->back()->with('error', 'Upload Failed');
            
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $story = Story::findOrFail($id);
        // $story->addViewWithExpiryDate(Carbon::now()->addHours(2));
        $comments = $story->comments()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.post.show', compact('story', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $story = Story::findOrFail($id);
        return view('admin.post.edit', compact('story'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all() ,[
            'title' => [
                'required',
                'max:255',
                Rule::unique('stories')->ignore($id)
            ],
            'content' => 'required',
            'description' => 'required',
            'image' => [
                'image',
                'max:1024'
            ]
        ]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            $fileName = ($request->file('image') != null) ? upload_file_to_story($request) : null; 
            fill_field_story($request, $fileName, $id);
            return redirect()->route('stories.index');
        }
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $story = Story::findOrFail($id);
        $story->delete();
        return redirect()->route('stories.index');
        
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
        return view('admin.post.index', compact('stories', 'search'));
    ;}

}
