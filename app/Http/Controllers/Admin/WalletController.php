<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index($id)
    {
        $user = User::with('wallet')->find($id);
        return view('admin.wallet.index', compact('user'));
    }
}
