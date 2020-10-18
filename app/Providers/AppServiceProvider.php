<?php

namespace App\Providers;

use App\User;
use App\Models\Post;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Information;
use App\Models\Notification;

// use App\User;
use App\Models\Product_User;
use App\Models\DepositRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        $V_productPropose = Product::where('active', 1)->inRandomOrder()->limit(15)->get();
        $V_recentPost = Post::where('active', 1)->orderBy('id','desc')->paginate(5);
        $V_rencentNotification = Notification::orderBy('id','desc')->paginate(4);
        $popularPosts = Post::where('active', 1)->orderBy('view', 'desc')->limit(8)->get();
        $categoryProduct = Category::orderBy('id', 'desc')->with('products')->get();
        $information = Information::first();
        $count_refund = Refund::where('status', 0)->get();
        $count_depositrequest = DepositRequest::where('status', 0)->get();
        $count_products = Product::all();
        $count_categories = Category::all();
        $count_post = Post::all();
        $count_notification = Notification::all();
        $count_user = User::all();
        $count_order = Order::all();
        $count_order_products = Product_User::all();
        $question_footer = Post::where('active', 0)->get();
        $V_payment_bank = Payment::where('type', 2)->limit(6)->get();
        $V_payment_wallet = Payment::where('type', 1)->limit(6)->get();
        // $sortByPopularity = Product::where('active', 1)->orderBy('view', 'desc')->paginate(18);
        view()->share([
            'V_productPropose'=> $V_productPropose,
            'V_recentPost' => $V_recentPost,
            'popularPosts' => $popularPosts,
            'categoryProduct' => $categoryProduct,
            'information'=>$information,
            'count_refund' => $count_refund,
            'count_depositrequest' => $count_depositrequest,
            'count_products' => $count_products,
            'count_categories' => $count_categories,
            'count_post' => $count_post,
            'count_notification' => $count_notification,
            'count_user' => $count_user,
            'count_order' => $count_order,
            'V_rencentNotification' => $V_rencentNotification,
            'question_footer' => $question_footer,
            'V_payment_wallet' => $V_payment_wallet,
            'V_payment_bank' => $V_payment_bank,
            'count_order_products' => $count_order_products 
            // 'sortByPopularity' => $sortByPopularity,
        ]);
    }
}
