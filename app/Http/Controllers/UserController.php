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

    public function bayarPost($id)
    {
        $user = Auth::user();
        $tagihan = $this->main->DetailTagihan($id);
        if($tagihan->jumlah > $user->saldo)
        {
            echo '<script>alert("Saldo anda tidak mencukupi");</script>';
        }
        else
        {
            $saldo = $user->saldo - $tagihan->jumlah;
            $this->main->updateSaldo($user->id, $saldo);
            $this->main->transactions($tagihan, $user->nisn);
            $this->main->updateTagihan($id);
            echo '<script>alert("Pembayaran berhasil");</script>';
        }
    }

    public function topuppost(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $transaction = $this->main->Debit($request->all(), $user->nisn);
        return redirect()->route('history.user');
    }

    public function topup()
    {
        $user = Auth::user();
        return view('main.user.topup_user', compact('user'));
    }

    public function MyInfo()
    {
        $user = Auth::user();
        $data = DB::select("select * from users s
        left join user_account ua on s.nisn = ua.nisn
        where s.id = ?", [$user->id])[0];
        return view('main.user.myinfo_user', compact('data'));
    }

    public function settings()
    {
        $user = Auth::user();
        $data = DB::select("select * from users s
        left join user_account ua on s.nisn = ua.nisn
        where s.id = ?", [$user->id])[0];

        return view('main.user.pengaturan_user', compact('data'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = Auth::user();
        DB::table('users')->where('id', $user->id)->update($request->except('_token'));
        return redirect()->back()->withInput();
    }

    public function verifikasi()
    {
        $user = Auth::user();
        $this->main->sendOTP($user->id);
    }

    public function confirm(Request $request)
    {
        $user = Auth::user();
        if($user->otp == $request->otp)
        {
            DB::table('users')->where('id', $user->id)->update([
                'verified' => 1,
                'otp' => mt_rand(100000, 999999)
            ]);
            return response()->json('ok');
        }
        return response()->json('fail');
    }

}
