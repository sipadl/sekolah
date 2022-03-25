<?php
namespace App\Classes;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class Main {

    public function __construct()
    {
        $this->url = 'http://139.99.60.117:8087/casaxcb-rest/';
    }

    function echo($data) {
        echo $data;
    }

    function url($uri, $data)
    {
        $data = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_PORT => "8087",
        CURLOPT_URL => $this->url.$uri,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return json_decode($response);
        }
    }

    function createMandatory($data = [])
    {
        $mandatory = [
                "request" => [
                    "cifValidationDto" => [
                    "idCif" => "",
                    "companyCode" => "10002",
                    "productCode" => "Merchant",
                    "name" => $data['fullname'],
                    "fullName" => $data['fullname'],
                    "gender" => $data['gender'] ?? 0,
                    "birthPlace" => $data['tempat_lahir'],
                    "birthDate" => $data['tanggal_lahir'],
                    "identityNumber" => "",
                    "identityType" => "",
                    "motherMaidenName" => "",
                    "callName" => $data['fullname'],
                    "phone" => $data['telp'],
                    "phoneType" => "1",
                    "email" => $data['email'],
                    "maritalStatus" => "Married",

                    "street1" => "",
                    "street2" => "",
                    "city" => "",
                    "province" => "",
                    "country" => "",
                    "postalCode" => "",
                    "lastEducation" => "1",
                    "taxFlag" => "0",
                    "isResidence" => "1",
                    "idValidDate" => "2099-01-01",
                    "printedName" => $data['fullname'],
                    "representativeName" => $data['fullname'],
                    "accountNumber" => "",
                    "purposeOfAccountOpening" => "Savings",
                    "addressType" => "1"
                ],
                "currency" => "IDR"
            ]
        ];
        $create = $this->url('account-opening/create-account-cif-mandatory', $mandatory);
        $hx = $create->response;

        $datax = [
            'nisn' => $data['nisn'] ?? 0,
            'cif_number' => $hx->cifNumber ?? 0,
            'account_number' => $hx->accountNumber ?? 0,
        ];

        $user = DB::table('user_account')->insert($datax);
        return 'Berhasil Membuat Akun';
    }

    function updateSaldo($id, $nominal)
    {
        $update = DB::table('users')->where('id',$id)->update([
            'saldo' => $nominal
        ]);

        return $update;
    }

    function TopUp($data = [], $is_admin = 0)
    {
        $user = DB::select('select s.*, ua.account_number from users s join user_account ua
        on ua.nisn = s.nisn
        where s.id = ? or s.nisn = ?',[$data['user_id'] ?? '', $data['nisn'] ?? ''] )[0] ?? null;

        $mandatory = [
            "request" => [
                "overbooking" => [
                    "accountFrom" => "",
                    "currencyFrom" => "IDR",
                    "accountTo" => $user->account_number, //Account Number
                    "currencyTo" => "IDR",
                    "amount" => $data['nominal'],
                    "description" => $data['keterangan'] ?? 'Top Up',
                    "trxCode" => "",
                    "username" => "",
                    "dataSource" => ""
                ]
            ]
        ];
        try {
            if($is_admin == 1){
            $topups = $this->url('overbooking/trx-overbook-batch', $mandatory);
            $transaction = [
                'nisn' => $user->nisn,
                'jumlah_bayar' => $data['nominal'],
                'tipe_bayar' => $is_admin, // admin = 1 // self = 0
                'tipe' => ($is_admin == 1)?'success':'waiting',
                'debit' => $data['nominal'],
                'ext' => json_encode($mandatory),
                'tagihan_id' => $data['tagihan_id'] ?? null,
                'bank_id' => $data['bank_id'] ?? 0,
                'created_at' => Carbon::now()
            ];
            $ts = DB::table('transactions')->insertGetId($transaction);
        }
                $current = $user->saldo;
                $new = $current + intval($data['nominal']);
                $tes = $this->updateSaldo($user->id, $new);
        } catch (\Exception $e) {
           return $e;

        }
    }

    function tagihan($id)
    {
        $tagihan = DB::select("select u.fullname,u.username, u.kelas, t.*, tt.tipe_tagihan from tagihans t
        left join users u on u.nisn = t.nisn
        left join tipe_tagihan tt on tt.id = t.tipe_tagihan
        where t.nisn = ?", [$id]);

        return $tagihan;
    }

    function riwayat($nisn)
    {
        $transaction = DB::select("select
        s.fullname, s.kelas, s.nisn, t.nisn, s.saldo, t.debit, t.tagihan_id, t.tipe, t.credit,
        t.created_at as tanggal, t.tipe as status, t.tipe_bayar, t2.tipe_tagihan , t2.keterangan
        from transactions t
        left join tagihans t2 on t2.id = t.tagihan_id
        left join tipe_tagihan tt on tt.id = t2.tipe_tagihan
        left join users s on s.nisn = t.nisn
        where s.nisn = ?", [$nisn]);
        return $transaction;
    }

    function Detailtagihan($id)
    {
        $tagihan = DB::select("select u.fullname, u.kelas, t.*, tt.tipe_tagihan from tagihans t
        left join users u on u.nisn = t.nisn
        left join tipe_tagihan tt on tt.id = t.tipe_tagihan
        where t.id = ?", [$id]);

        return $tagihan[0];
    }

    function transactions($data = [], $user)
    {
        $transaction = [
            'nisn' => $user,
            'jumlah_bayar' => $data->jumlah,
            'tipe_bayar' => 0, // admin = 1 // self = 0
            'tipe' => 'success',
            'credit' => $data->jumlah,
            'tagihan_id' => $data->id ?? null,
            'bank_id' => $data->bank_id ?? 0,
            'created_at' => Carbon::now()
        ];
        DB::table('transactions')->insertGetId($transaction);

        return $transaction;
    }

    function updateTagihan($id)
    {
        DB::table('tagihans')->where('id', $id)->update([
            'status' => 1
        ]);
    }

    function Debit($data = [], $user)
    {
        $transaction = [
            'nisn' => $user,
            'jumlah_bayar' => $data['jumlah'],
            'tipe_bayar' => 0, // admin = 1 // self = 0
            'tipe' => 'waiting',
            'debit' => $data['jumlah'],
            'tagihan_id' => $data['id'] ?? null,
            'bank_id' => $data['bank'] ?? 0,
            'created_at' => Carbon::now()
        ];
        DB::table('transactions')->insertGetId($transaction);

        return $transaction;
    }

    function riwayatAdmin()
    {
        $transaction = DB::select("select
        t.id,
        s.fullname, s.kelas, s.nisn, t.nisn, s.saldo, t.debit, t.tagihan_id, t.tipe, t.credit,
        t.created_at as tanggal, t.tipe as status, t.tipe_bayar, t2.tipe_tagihan , t2.keterangan
        from transactions t
        left join tagihans t2 on t2.id = t.tagihan_id
        left join tipe_tagihan tt on tt.id = t2.tipe_tagihan
        left join users s on s.nisn = t.nisn
        where t.tipe = 'waiting'");

        return $transaction;
    }

    function updateStatusTransaction($id)
    {
        DB::table('transactions')->where('id', $id)->update([
            'tipe' => 'success'
        ]);
    }


    function sendOTP($user_id)
    {
        $user = DB::table('users')->where('id', $user_id)->first();
        $email = $user->email;
        $otp = $user->otp;
            $data = [
                'title' => 'Code OTP Anda adalah '.$otp,
                'url' => env('BASE_URL')
            ];
        Mail::to($email)->send(new SendMail($data));
    }

    function pelunasan($idTagihan, $userId, $jumlah = 0) {

        $tagihan = $this->DetailTagihan($idTagihan);
        $user = DB::table('users')->where('id', $userId)->first();
        $saldo = $user->saldo - $tagihan->jumlah;
        $this->updateSaldo($user->id, $saldo);
        $this->transactions($tagihan, $user->nisn);
        $this->transfer($user->id, $tagihan->jumlah);
        $this->updateTagihan($idTagihan);
    }

    function checkTagihan($user)
    {
        $tagihan = DB::table('tagihans')->where('nisn', $user->nisn)->where('tipe_tagihan', 1)
        ->where('status', 0)->get();
        $map = array_map(function($x) use ($user) {
            $y = [];
            if($user->saldo >= $x->jumlah){
                $this->pelunasan($x->id, $user->id);
                array_push($y, true );
            }else{
                array_push($y, false );
            }
                return $y;
        }, $tagihan->toArray());
        $count = array_filter($map, function($x) {
            return $x[0] == true;
        });
        return `<script>alert('`.count($count).` Berhasil Dibayarkan secara otomatis')</script>`;
    }

    function transfer($id, $jumlah)
    {
        $user = DB::select('select s.*, ua.account_number from users s join user_account ua
        on ua.nisn = s.nisn
        where s.id = ? ',[$id] )[0] ?? null;


        $admin = DB::select('select s.*, ua.account_number from users s join user_account ua
        on ua.nisn = s.nisn where s.id = 1')[0] ?? null;
        $mandatory = [
            "request" => [
                "overbooking" => [
                    "accountFrom" => $user->account_number,
                    "currencyFrom" => "IDR",
                    "accountTo" => $admin->account_number, //Account Number
                    "currencyTo" => "IDR",
                    "amount" => $jumlah,
                    "description" => 'Transfer',
                    "trxCode" => "",
                    "username" => "",
                    "dataSource" => ""
                ]
            ]
        ];
            $topups = $this->url('overbooking/trx-overbook-batch', $mandatory);
    }
}
