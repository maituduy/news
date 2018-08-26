<?php
    use App\Category;
    use App\Story;
    use App\Tag;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;

    function slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        $str = str_slug($str);
        return $str;
    }

    function upload_file_to_story($request) {
        $fileExtension = $request->file('image')->getClientOriginalExtension(); // Lấy . của file
                
        // Filename cực shock để khỏi bị trùng
        $fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
        // Thư mục upload
        $uploadPath =  public_path('/images/admin/story'); // Thư mục upload
        // Bắt đầu chuyển file vào thư mục
        
        $request->file('image')->move($uploadPath, $fileName);

        return $fileName;
    }

    function fill_field_story($request, $fileName, $id = null) {
        $tags_id = [];
        if (count($request->tags)>0)
            foreach($request->tags as $tag) {
                $item = Tag::firstOrCreate(['name' => $tag]);
                $item->save();
                array_push($tags_id, $item->id);
            }
        $story = ($id != null) ? Story::find($id) : new Story();
        $story->title = $request->title;
        $story->content = $request->content;
        $story->description = $request->description;
        $story->slug = slug($story->title);
        if ($fileName != null) $story->avatar = $fileName;
        $story->admin()->associate(auth()->user());
        $story->category()->associate(Category::findOrFail($request->category));
        $slug_category = slug($story->category->name);
        $story->url = url("/$slug_category/$story->slug");
        $story->save();   
        $story->tags()->sync($tags_id);
        
    }

    function format_time_store($story) {
        return Carbon::parse($story->created_at)->format('l d-m-Y h:i:s A');
    }

    function diffForHumans($comment) {
        return Carbon::parse($comment->created_at)->diffForHumans();
    }

    function getStoriesToday() {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        return Story::whereBetween('created_at', [$today, $tomorrow])->count();
    }

    function getStoriesLast7Days() {
        $today = Carbon::today();
        $start = $today->subWeek();
        $day = $start->copy();
        $res = [];
        for ($i = 0; $i<7; $i++) {
            array_push($res, Story::whereBetween('created_at', [$start, $day->addDay()])->count());
            $start->addDay();
        }
        return $res;
    }

    function getAllViewsToday() {
       $stories = Story::all();
       $sum = 0;
       foreach ($stories as $story)
         $sum += $story->getViewsToday();
       return $sum;        
    }

    function getAllViewsLast7Days() {
        $today = Carbon::today();
        $start = $today->subWeek();
        $day = $start->copy();
        $res = [];
        for ($i = 0; $i<7; $i++) {
            array_push($res, DB::table('views')->whereBetween('viewed_at', [$start, $day->addDay()])->count());
            $start->addDay();
        }
        return $res;     
     }
?>