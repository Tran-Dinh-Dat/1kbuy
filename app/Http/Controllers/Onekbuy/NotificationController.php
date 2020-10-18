<?php

namespace App\Http\Controllers\Onekbuy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::paginate(20);
        return view('onekbuy.notification.index', compact('notifications'));
    }

    public function show($slug, $id)
    {
        $notification = Notification::findOrFail($id);
        if(!$notification){
            return redirect()->route('onekbuy.index.index');
        }
        if($slug != $notification->slug){
            return redirect()->route('onekbuy.notification.show', ['slug' => $notification->slug, 'id' => $id]);
        }
        $previous = notification::where('id', '<', $notification->id)->orderBy('id','desc')->first();
        $next = notification::where('id', '>', $notification->id)->orderBy('id')->first();
        return view('onekbuy.notification.detail',compact('notification', 'previous', 'next'));
    }

    public function search(Request $request)
    {
        $search = Notification::where('title','LIKE','%'.$request->title.'%')->orderby('id','desc')->paginate(8);
        return view('onekbuy.notification.search',compact('search'));
    }
}
