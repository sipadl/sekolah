<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Main;
use DB;
use Validator;
use Hash;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\TagihanImport;
use App\Imports\AdminImport;
use App\Exports\UsersExport;
use App\Exports\RiwayatTagihan;
use App\Exports\AdminExport;
use App\Exports\UsersTagihan;
use App\Exports\SaldoExport;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user->roles == 0 ){
            $cek = $this->main->checkTagihan($user);
        }
        $tagihan = DB::select("select sum(jumlah) as total from tagihans where nisn = ? and status = 0", [$user->nisn]);
        return view('main.user.dashboard', compact('user','tagihan'));
    }

    public function admin()
    {
        $admin = DB::table('users')->where('roles', 4)->orwhere('roles', 3)->where('status', 0)->get();
        return view('main.user.admin',compact('admin'));
    }

    public function getDetailAdmin($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('main.user.update.update_admin', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {

        if(isset($request->thumbnail))
        {
            $file = $request->file('thumbnail');
            $fileName = $file->getClientOriginalName();
            $request->file('thumbnail')->move("images/", $fileName);
            $thumbnail = "images/".$fileName;

            DB::table('users')->where('id', $id)->update([
                'thumbnail' => $thumbnail,
            ]);
        }
        $user = DB::table('users')->where('id', $id)->first();
        $update = DB::table('users')->where('id',$id)->update($request->except('_token','thumbnail','password'));
        if($request->password)
        {
            $masuk = Hash::check($request->password, $user->password);
            if($masuk){
                DB::table('users')->where('id', $id)->update([
                    'password' => Hash::make($request->password),
                ]);
            }
        }
        return redirect()->route('me')->with('msg', 'Data berhasil diubah');
    }

    public function getDetailTagihan($id)
    {
        $tagihan = DB::table('tagihans')->where('id', $id)->first();
        $tipe = DB::table('tipe_tagihan')->where('id', $tagihan->tipe_tagihan)->get();
        return view('main.user.update.tagihan', compact('tagihan','tipe'));
    }

    public function DetailTagihanPost(Request $request, $id)
    {
        $tagihan = DB::table('tagihans')->where('id', $id)->update($request->except('_token'));
        return redirect()->route('tagihan')->with('msg', 'Data berhasil diubah');
    }

    public function deleteTagihan($id)
    {
        $tagihan = DB::table('tagihans')->where('id', $id)->delete();
        return redirect()->route('tagihan')->with('msg', 'Data berhasil dihapus');
    }

    public function delete($id)
    {
        DB::table('users')->where('id', $id)->update([
            'status' => 1
        ]);
        return redirect()->back();
    }

    public function addAdmin()
    {
        return view('main.user.add_admin');
    }

    public function postAddAdmin(Request $request)
    {
        $rules = [
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->with('msg' , $validator->errors()->first() );
        }
        $data = [
            'fullname' => $request->username,
            'name' => $request->username,
            'username' => $request->username,
            'kelas' => 0,
            'nisn' => 0,
            'email' => '',
            'password' => hash::make($request->password),
            'otp' => mt_rand(100000, 999999),
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'thumbnail' => '/images/default-profile.jpg',
            'roles' => $request->role,
        ];
        DB::table('users')->insert($data);
        return redirect()->route('admin')->with('msg' , 'Berhasil Menambahkan Data');
    }

    public function siswa()
    {
        $user = DB::table('users')->where('roles', 0)->where('status', 0)->get();
        return view('main.user.siswa', compact('user'));
    }

    public function siswaAdd()
    {
        return view('main.user.add_siswa');
    }

    public function siswaAddPost(Request $request)
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
        $file = $request->file('thumbnail');
        $fileName = $file->getClientOriginalName();
        $location = 'images/';
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
            'thumbnail' => $location.$fileName,
            'roles' => 0,
            'created_at' => Carbon::now()
        ];
        try{
            $createAccount = $this->main->createMandatory($data);
            $user = DB::table('users')->insert($data);
            $file->move($location, $fileName);

            return redirect()->route('siswa')->with('msg' , 'Berhasil Menambahkan Data');
        } catch(\Exception $e)
        {
            dd($e);
        }
    }

    public function getDetailSiswa($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('main.user.update.siswa', compact('user'));
    }

    public function siswaDelete($id)
    {
        DB::table('users')->where('id', $id)->update([
            'status' => 1
        ]);
        return redirect()->back();
    }

    public function tagihan()
    {
        $tagihan = DB::table('tagihans')->get();
        return view('main.user.tagihan', compact('tagihan'));
    }

    public function tagihanAdd()
    {
        $tipe = DB::table('tipe_tagihan')->where('status', 1)->get();
        return view('main.user.add_tagihan', compact('tipe'));
    }

    public function tagihanAddPost(Request $request)
    {
        $rules = [
            'tipe_tagihan' => ['required', 'exists:tipe_tagihan,id'],
            'tipe' => 'required',
            'jumlah' => 'required',
            'nisn' => ['required',
                        // 'exists:users,nisn'
                    ],
        ];
        $validator = Validator::make($request->all(), $rules);
        if(!$validator){
            return redirect()->back()->withErrors($validator);
        }

        $data = [
            'tipe_tagihan' => $request->tipe_tagihan,
            'tipe' => $request->tipe,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'nisn' => $request->nisn,
            'created_at' => Carbon::now()
        ];
        DB::table('tagihans')->insert($data);
        return redirect()->route('tagihan')->with('msg' , 'Berhasil Menambahkan Data');
    }

    public function Saldos()
    {
        $user = DB::table('users')->where('roles', 0)->where('status', 0)->get();
        return view('main.user.topup', compact('user'));
    }

    public function SaldosPost(Request $request)
    {
        $rules = [
            'user_id' => ['required',
                        // 'exists:users,nisn'
                    ],
            'nominal' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);
        if(!$validator){
            return redirect()->back()->withErrors($validator);
        }
        $topup = $this->main->TopUp($request->all(), 1);
        return redirect()->route('tagihan.topup')->with('msg' , 'Berhasil Melakukan Top Up');
    }

    public function history()
    {
        $data = DB::select("select u.*, keterangan, tt.tipe_tagihan as tagihan,t.jumlah,t.tipe, tu.order_number from tagihan_user tu
        left join users u on u.id = tu.user_id
        left join tagihans t on tu.tagihan_id = t.id
        left join tipe_tagihan tt on t.tipe_tagihan = tt.id ");

        return view('main.user.history', compact('data') );
    }

    public function listSaldo()
    {
        $data = DB::table('users')->where('roles', 0)->where('status', 0)->get();
        return view('main.user.saldo', compact('data'));
    }

    public function api()
    {
        $main = $this->main->sendOTP(9);
        return $main;
    }

    public function waiting()
    {
        $tagihan = $this->main->riwayatAdmin();
        return view('main.user.waiting_list', compact('tagihan'));
    }

    public function accept($id)
    {
        $user = Auth::user();
        $tagihan = DB::table('transactions')->where('id', $id)->first();
        $data = [
            'nisn' => $tagihan->nisn,
            'nominal' => $tagihan->jumlah_bayar,
        ];
        $topup = $this->main->TopUp($data, 0);
        $this->main->updateStatusTransaction($id);
        return redirect()->back();
    }
    public function deny($id)
    {
        $cancel = DB::table('transactions')->where('id', $id)->update([
            'tipe' => 'deny'
        ]);
        return redirect()->back();
    }

    public function settingsAdmin()
    {
        $data = Auth::user();
        return view('main.user.update.pengaturan_admin', compact('data'));
    }

    public function fileImportExport()
    {
       return view('main.user.file-import');
    }

    public function ImportAdmin()
    {
        return view('main.user.import-admin');
    }

    public function ImportTagihan()
    {
        return view('main.user.import-tagihan');
    }
    /**
     */
    public function fileImportAdmin(Request $request)
    {
        $file = $request->file('file')->move(public_path('file'),
        $getname = $request->file('file')->getClientOriginalName());
        $status = Excel::import(new AdminImport, public_path('file/'.$getname));
        return back()->with('msg' , 'Berhasil Menambahkan Data');
    }

    public function fileImportTagihan(Request $request)
    {
        $file = $request->file('file')->move(public_path('file'),
        $getname = $request->file('file')->getClientOriginalName());
        $status = Excel::import(new TagihanImport, public_path('file/'.$getname));
        return back()->with('msg' , 'Berhasil Menambahkan Data');
    }

    public function fileImport(Request $request)
    {
        $file = $request->file('file')->move(public_path('file'),
        $getname = $request->file('file')->getClientOriginalName());
        $status = Excel::import(new UsersImport, public_path('file/'.$getname));
        return back()->with('msg' , 'Berhasil Menambahkan Data');
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport()
    {
        return Excel::download(new UsersExport, 'export-user.xlsx');
    }

    public function fileExportAdmin()
    {
        return Excel::download(new AdminExport, 'export-admin.xlsx');
    }

    public function fileExportTagihan()
    {
        return Excel::download(new UsersTagihan, 'export-tagihan.xlsx');
    }

    public function ExportRiwayatTagihan()
    {
        return Excel::download(new RiwayatTagihan, 'export-riwayat-tagihan.xlsx');
    }
    public function ExportSaldo()
    {
        return Excel::download(new SaldoExport, 'export-saldo-siswa.xlsx');
    }
}
