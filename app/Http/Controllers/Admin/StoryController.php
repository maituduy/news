<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Story;
use Illuminate\Support\Facades\Validator;

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
        $stories = Story::orderBy('created_at', 'desc')->get();
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
            'title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required',
            'image' => 'image|max:1024'
        ]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        else {
            if ($request->file('image')->isValid()) {
                // File này có thực, bắt đầu đổi tên và move
                $fileExtension = $request->file('image')->getClientOriginalExtension(); // Lấy . của file
                
                // Filename cực shock để khỏi bị trùng
                $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
                // Thư mục upload
                $uploadPath =  url('/public/images/admin/story'); // Thư mục upload
                // Bắt đầu chuyển file vào thư mục
                
                $request->file('image')->move($uploadPath, $fileName);
                $story = new Story();
                $story->title = $request->title;
                $story->content = $request->content;
                $story->description = $reques->description;
                
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
    }

}