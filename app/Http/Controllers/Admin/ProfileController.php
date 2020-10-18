<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::with('profile')->find($id);
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::where('user_id', $id)->first();
        if ($profile == null) {
            $profile = new Profile;
        }
        if ($request->file('avatar') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $profile->avatar;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('avatar');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $profile->avatar = $filename;
        } 

        $profile->user_id = $id;
        $profile->fullname = $request->fullname;
        $profile->birthday = $request->birthday;
        $profile->address = $request->address;
        $profile->gender = $request->gender;
        $profile->phone_number = $request->phone_number;
        $profile->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $profile->save();
        return back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
