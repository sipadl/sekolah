<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('main.auth.login');
    }

    public function logins(Request $request)
    {
        $user = DB::table('users')->where('username', $request->username)->first();
        // ->orWhere('nisn', $request->username)->first();
        if($user)
        {
            if (Hash::check($request->password, $user->password)) {
                Auth::loginUsingId($user->id);
                return redirect()->route('user');
            }
        }
        return redirect()->back()->with(['msg' => 'username tidak ditemukan'])->withInput();;
    }

    // Untuk Default
    // public function register()
    // {
    //     $data = [
    //         'name' => 'admin',
    //         'username' => 'admin',
    //         'fullname' => 'administrator',
    //         'gender' => 1,
    //         'kelas' => 0,
    //         'nisn' => 0,
    //         'email' => 'admin@gmail.com',
    //         'password' => hash::make('admin'),
    //         'otp' => mt_rand(100000, 999999),
    //         'tempat_lahir' => '',
    //         'tanggal_lahir' => '',
    //         'thumbnail' => '',
    //         'roles' => 4,
    //     ];
    //     $user = DB::table('users')->insert($data);
    //     if($user){
    //         return response()->json(true);
    //     }
    //     return response()->json(false);
    // }

    public function register()
    {
        return view('main.auth.regis');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
