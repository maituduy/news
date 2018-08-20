<?php
    use App\Category;
    use App\Story;
    use App\Tag;
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

    function fill_field_story($request, $fileName) {
        $tags_id = [];
        if (count($request->tags)>0)
            foreach($request->tags as $tag) {
                $item = Tag::firstOrCreate(['name' => $tag]);
                $item->save();
                array_push($tags_id, $item->id);
            }
        $story = new Story();
        $story->title = $request->title;
        $story->content = $request->content;
        $story->description = $request->description;
        $story->slug = str_slug(slug($story->title));
        $story->avatar = $fileName;
        $story->admin()->associate(auth()->user());
        $story->category()->associate(Category::findOrFail($request->category));
        $slug_category = str_slug(slug($story->category->name));
        $story->url = url("/$slug_category/$story->slug");
        $story->save();   
        $story->tags()->sync($tags_id);
        
    }
?>