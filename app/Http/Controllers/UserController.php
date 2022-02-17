<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Main;
use DB;
use Validator;
use Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
        $this->main = new Main();
    }

    public function index()
    {
        $user = $this->user;
        return view('main.user.dashboard', compact('user'));
    }

    public function tagihan()
    {
        $user = Auth::user();
        $tagihan = $this->main->tagihan($user->nisn);
        return view('main.user.tagihan_user ', compact('tagihan','user'));
    }

    public function history()
    {
        $user = Auth::user();
        $tagihan = $this->main->riwayat($user->nisn);
        return view('main.user.riwayat_user', compact('tagihan','user'));
    }

    public function bayar($id)
    {
        $user = Auth::user();
        $tagihan = $this->main->DetailTagihan($id);
        return view('main.user.bayar_user', compact('tagihan','user'));
    }

    public function topup()
    {
        $user = Auth::user();
        return view('main.user.topup_user', compact('user'));
    }

}
