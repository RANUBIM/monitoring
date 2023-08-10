<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Alats;
use App\Models\Users;
use App\Models\Bahans;
use App\Models\Peminjamans;
use App\Models\Penggunaans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == "Kepala Jurusan" || Auth::user()->role == "Laboran") :
            $dataAlat = Alats::with('dataLabor')->get();
            $jumlahAlat = count($dataAlat);
            $dataBahan = Bahans::with('dataLabor')->get();
            $jumlahBahan = count($dataBahan);
            $dataPeminjaman = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->get();
            $jumlahPeminjaman = count($dataPeminjaman);
            $dataPenggunaan = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->get();
            $jumlahPenggunaan = count($dataPenggunaan);
            $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->get();
            $dataLog = Logs::with('dataUser')->orderBy('id', 'DESC')->paginate(5);
        else:
            $dataAlat = Alats::with('dataLabor')->get();
            $jumlahAlat = count($dataAlat);
            $dataBahan = Bahans::with('dataLabor')->get();
            $jumlahBahan = count($dataBahan);
            $dataPeminjaman = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('user_id',Auth::user()->id)->get();
            $jumlahPeminjaman = count($dataPeminjaman);
            $dataPenggunaan = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->where('user_id',Auth::user()->id)->get();
            $jumlahPenggunaan = count($dataPenggunaan);
            $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('user_id',Auth::user()->id)->get();
            $dataLog = Logs::with('dataUser')->where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);
        endif;

        // dd($jumlahAlat);
        

        // $datas = Log::latest()->paginate(10);
        // $datasCounted = Log::latest()->take(5)->get();
        // return view('transactions.log.index', compact('datas'));
        
        return view('template.dashboard', compact('datas','jumlahAlat','jumlahBahan','dataPeminjaman','dataPenggunaan','dataLog','jumlahPeminjaman','jumlahPenggunaan'));
        // return view('template.dashboard')
    }
}
