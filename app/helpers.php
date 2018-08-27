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
        $image = base64_encode(file_get_contents($request->file('image')));
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.imgur.com/3/image",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"image\"\r\n\r\n$image\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Client-ID 3c7e5e822162285",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
                ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            return json_decode($response)['data']['link'];
        }
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

    function checkLikeAuthUser($comment) {
        $auth_id = auth()->user()->id;
        $likes = $comment->likes()->get();
        $ids_liked = [];
        foreach ($likes as $like)
            array_push($ids_liked, $like->user->id);
        return in_array($auth_id, $ids_liked);
    }
?>