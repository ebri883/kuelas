<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\DetailTransaksi;
use App\DetailUser;
use Auth;

class PengurusController extends Controller
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

        return view('pengurus.index',['user' => $user, 'user2' => $user2, 'kas' => $kas, ]);
    }


    public function transaksi()
    {
        return view('pengurus.transaksi');
    }

    public function pemasukan()
    {
        return view('pengurus.pemasukan');
    }

    public function prosespemasukan(Request $req)
    {
        
        $kelaslink = Auth::user()->detailUser()->first();
        
        $masuk = Transaksi::create([
            'catatan' => $req->catatan,
            'pemasukan' => $req->pemasukan,
            'pengeluaran' => $req->pengeluran = 0,
            'id' => $req->id,
        ]);
            
        $masuk2 = DetailTransaksi::create([
            'id_user' => $kelaslink->id_user,
            'kode_kelas' => $kelaslink->kode_kelas,
            'id_transaksi' => $req->id,
        ]);

        $masuk->save();
        $masuk2->save();

        return redirect('/pengurus/transaksi');
    }

    public function pengeluaran()
    {
        return view('pengurus.pengeluaran');
    }

    public function prosespengeluaran(Request $req)
    {
        $kelaslink = Auth::user()->detailUser()->first();

        $keluar = Transaksi::create([
            'catatan' => $req->catatan,
            'pengeluaran' => $req->pengeluaran,
            'pemasukan' => $req->pemasukan = 0,
            'id' => $req->id,
        ]);

        // $idtransaksi = Transaksi::where('id', $req->id)->first();
            
        $keluar2 = DetailTransaksi::create([
            'id_user' => $kelaslink->id_user,
            'kode_kelas' => $kelaslink->kode_kelas,
            'id_transaksi' => $req->id,
        ]);
        $keluar->save();
        $keluar2->save();

        return redirect('/pengurus/transaksi');
    }

    public function profile()
    {
        $kodeKelas = Auth::user()->detailUser()->first();
        $userdetail = DetailUser::where('kode_kelas', $kodeKelas->kode_kelas)->first();
        // dd($userdetail);
        return view('pengurus.profile', ['user' => $userdetail]);
    }
}
