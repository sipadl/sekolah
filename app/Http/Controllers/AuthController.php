<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;
use Validator;
use Auth;
use Carbon\Carbon;
use App\Classes\Main;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->main = new Main();
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

    public function inikontol(Request $request)
    {
        $rules = [
            'username' => 'required',
            'kelas' => 'required',
            'nisn' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'thumbnail' => 'required',
            'full_name' => 'required',
            'telp' => 'required',
            'gender' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if(!$validator){
            return redirect()->back()->withErrors($validator);
        }
        if($request->file('thumbnail')){
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $location = 'images/';
        }
        $data = [
            'name' => explode(" ",$request->full_name)[0],
            'fullname' => $request->full_name,
            'username' => $request->username,
            'gender' => $request->gender,
            'kelas' => $request->kelas,
            'nisn' => $request->nisn,
            'email' => $request->email,
            'password' => $request->password ? hash::make($request->password) : hash::make('123456789'),
            'telp' => $request->telp,
            'otp' => mt_rand(100000, 999999),
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'thumbnail' => $request->file('thumbnail') ? $location.$fileName : '',
            'roles' => 0,
            'created_at' => Carbon::now()
        ];
        try{
            $createAccount = $this->main->createMandatory($data);
            $user = DB::table('users')->insert($data);
            if($request->file('thumbnail')){
            $file->move($location, $fileName);
            }

            return redirect()->route('/')->with('msg' , 'Berhasil Menambahkan Data');
        } catch(\Exception $e)
        {
            dd($e);
        }
    }

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
