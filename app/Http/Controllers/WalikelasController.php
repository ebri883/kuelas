<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\DetailUser;
use App\DetailTransaksi;
use App\Kelas;

class WalikelasController extends Controller
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

        return view('walikelas.index',['user' => $user, 'user2' => $user2, 'kas' => $kas, ]);
    }

    public function TambahUser()
    {
        return view('walikelas.tambah');
    }

    public function AddUser(Request $request)
    {
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'absen' => $request->absen,
        ]);

        $userlink = User::where('email',$request->email)->first();
        $kelaslink = Auth::user()->detailUser()->first();

        $detailUser = DetailUser::create([
            'id_user'=> $userlink->id,
            'kode_kelas'=> $kelaslink->kode_kelas,
        ]);

        $user->save();
        $detailUser->save();

        return redirect('/walikelas');
    }

    public function profile()
    {
        $kodeKelas = Auth::user()->detailUser()->first();
        $userdetail = DetailUser::where('kode_kelas', $kodeKelas->kode_kelas)->first();
        // dd($userdetail);
        return view('walikelas.profile', ['user' => $userdetail]);
    }
    
    public function transaksi()
    {
        return view('walikelas.transaksi');
    }

}