<?php

namespace App\Http\Controllers\Onekbuy;

use App\Models\Slide;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Post;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Carbon\Carbon;

class IndexController extends Controller
{

    public function index()
    {
        $popularProducts = Product::where('active', 1)->orderBy('view', 'desc')->limit(10)->get();
        $categories = Category::orderBy('position', 'asc')->skip(0)->take(5)->get(); //get first 10 rows
        $categoriesAside = Category::orderBy('position', 'asc')->skip(5)->take(8)->get(); //get next 10 rows
        $productChooseTheMost = Product::where('active', 1)->orderBy('buyer_number', 'desc')->limit(20)->get();
        $productPropose = Product::inRandomOrder()->limit(28)->get();
        $slides = Slide::all();
        $banners = Banner::orderBy('id', 'desc')->limit(2)->get();
        return view('onekbuy.index.index', compact(
            'popularProducts', 
            'categories', 
            'categoriesAside',
            'productChooseTheMost', 
            'productPropose',
            'slides',
            'banners'
        ));
    }
    public function sitemap()
    {
        $products = Product::where('active', 1)->get();
        $cats = Category::all();
        $posts = Post::where('active', 1)->get();
        $infos = Post::where('active', 0)->get();
        $notifies = Notification::all();
        return response()->view('onekbuy.index.sitemap', [
            'products' => $products,
            'cats' => $cats,
            'infos' => $infos,
            'posts' => $posts,
            'notifies' => $notifies,
        ])->header('Content-Type', 'text/xml');
    }
}

