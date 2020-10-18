<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use CarBon\CarBon;

class PostController extends Controller
{
    public function question()
    {
        $posts = Post::where('active', 2)->paginate(10);
        return view('admin.post.question', compact('posts'));
    }

    public function index()
    {
        $posts = Post::where('active', '!=', 2)->paginate(50);
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts',
            'content' => 'required',
            'description' => 'required',
            'key_word' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required',
        ], [
            'title.required' => 'Bạn cần nhập tiều đề',
            'title.unique' => 'Tiều đề đã tồn tại',
            'description.required' => 'Bạn cần nhập mô tả',
            'key_word.required' => 'Bạn cần nhập keyword',
            'content.required' => 'Bạn cần nhập nội dung',
            'image.required' => 'Bạn cần tải hình ảnh',
            'image.mimes' => 'Bạn cần tải hình ảnh đúng định dạng jpg, jpeg, png, gif',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $post = new Post;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->description = $request->description;
        $post->key_word = $request->key_word;
        $post->active = $request->active;
        $post->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $post->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $post->image = $filename;
        } 
       
        $post->save();
        return redirect(route('admin.post.index'))->with('success', 'Thêm tin tức thành công!');
    }

    public function show($id)
    {
        return 1;
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title,'. $id,
            'content' => 'required',
            'description' => 'required',
            'key_word' => 'required',
        ], [
            'title.required' => 'Bạn cần nhập tiều đề',
            'title.unique' => 'Tiều đề đã tồn tại',
            'key_word.required' => 'Bạn cần nhập mô tả',
            'description.required' => 'Bạn cần nhập mô tả',
            'content.required' => 'Bạn cần nhập nội dung',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }        
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->key_word = $request->key_word;
        $post->content = $request->content;
        $post->description = $request->description;
        $post->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $post->active = $request->active;

        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $post->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $post->image = $filename;
        } 
       
        $post->update();
        return redirect(route('admin.post.index'))->with('success', 'Cập nhật tin tức thành công!');
    }

    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        $posts->delete();
        return response()->json([
            'message' => 'Xóa tin tức thành công!'
        ]);
    }

    // public function active(Request $request)
    // {
    //     $id = $request->id;
    //     return '1';
    //     $post = Post::findOrFail($id);
    //     if ($post->active == 0) {
    //         $post->active = 1;
    //         $post->save();
    //         return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><i class="fa fa-check text-success"></i> </a>';
    //     } else {
    //         $post->active= 0;
    //         $post->save();
    //         return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><i class="fa fa-close text-danger"></i> </a>';
    //     }
    // }
    
}
