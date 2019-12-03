<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transaksi;
use App\DetailTransaksi;
use App\DetailUser;

class AnggotaController extends Controller
{
    public function index(){
        $kodeKelas = Auth::user()->detailUser()->first();

        $user = Auth::user()->detailUser()->get();
        $user1 = DetailUser::where('kode_kelas', $kodeKelas->kode_kelas)
                            ->where('users.absen', '>=', '1')
                            ->join('users', 'detail_users.id_user', '=', 'users.id')
                            ->get();
        $user2 = $user1 -> sortBy('user.absen');
        $kas = DetailTransaksi::where('kode_kelas', $kodeKelas->kode_kelas)->get();

        return view('anggota.index',['user' => $user, 'user2' => $user2, 'kas' => $kas, ]);
    }

    public function profile()
    {
        $kodeKelas = Auth::user()->detailUser()->first();
        $userdetail = DetailUser::where('kode_kelas', $kodeKelas->kode_kelas)->first();
        // dd($userdetail);
        return view('anggota.profile', ['user' => $userdetail]);
    }
}
