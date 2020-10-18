<?php

namespace App\Http\Controllers\Onekbuy;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $post = Post::where('active', 1)->orderBy('id','desc')->paginate(5);
    	return view('onekbuy.post.index',compact('post'));
    }
    public function detail($slug,$id){
        $post = Post::where('active', 1)->find($id);
        if(!$post){
            return redirect(route('onekbuy.index.index'));
        }
        if($slug != $post->slug){
            return redirect()->route('onekbuy.post.detail', ['slug' => $post->slug, 'id' => $id]);
        }
        // $postid = Post::orderBy('id','desc')->paginate(4);
        $previous = Post::where('active', 1)->where('id', '<', $post->id)->orderBy('id','desc')->first();
        $next = Post::where('active', 1)->where('id', '>', $post->id)->orderBy('id')->first();

        $minutes = '60';
        $key = 'detail' . $post->id;
        if (Cache::has($key)) {
            Cache::put($key, 1, $minutes);
            $post->view +=1;
            $post->save();
        }

        return view('onekbuy.post.detail')->with(compact('post','previous','next'));
    }

    public function info($slug){
        $post = Post::where('active', 0)->where('slug','like' ,'%'.$slug.'%')->first();
        if(!$post){
            return redirect()->route('onekbuy.index.index');
        }
        if($slug != $post->slug){
            return redirect()->route('onekbuy.post.info', $post->slug);
        }
        return view('onekbuy.post.info', compact('post'));
    }

    public function searchBlog(Request $request){
        // dd($request->name);
        $search = Post::where('active', 1)->where('title','like','%'.$request->title.'%')->orderby('id','desc')->paginate(8);
        // dd($search);
        // $search -> name = $request -> name;
        return view('onekbuy.post.search',compact('search'));
    }
}
