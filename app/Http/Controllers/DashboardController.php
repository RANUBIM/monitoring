<?php

namespace App\Http\Controllers;

use App\Charts\DetailChart;
use App\Charts\PeminjamansChart;
use App\Charts\penggunaansChart;
use App\Charts\PeminjamansPenggunaansChart;
use App\MyLibrary;
use App\Models\Logs;
use App\Models\Alats;
use App\Models\Users;
use App\Models\Bahans;
use App\Models\Peminjamans;
use App\Models\Penggunaans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{   
    // public function getNotif()
    // {   


    //     if (Auth::user()->role == "Kepala Jurusan" || Auth::user()->role == "Laboran") :
    //         $dataNotif = Logs::with('dataUser')->orderBy('id', 'DESC')->limit(5)->get();
    //     else:
    //         $dataNotif = Logs::with('dataUser')->where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->limit(5)->get();
    //     endif;
        
    //     // dd($dataNotif);
    //     return $dataNotif;
    // }

    public function index(PeminjamansChart $peminjamansChart, PenggunaansChart $penggunaansChart, PeminjamansPenggunaansChart $peminjamansPenggunaansChart, DetailChart $detailChart)
    {   
        $user = ['role' => Auth::user()->role, 'id' => Auth::user()->id];
        $dataNotif = MyLibrary::ambilNotif($user);
        // dd($dataNotifikasi);

        // CHART
        $dataPeminjamanChart = $peminjamansChart->build();
        $dataPenggunaanChart = $penggunaansChart->build();
        $dataPeminjamanPenggunaanChart = $peminjamansPenggunaansChart->build();
        $dataDetailChart = $detailChart->build();


        if (Auth::user()->role == "Kepala Jurusan") :
            $dataAlat = Alats::with('dataLabor')->get();
            // dd($dataAlat);

            
            $jumlahAlat = Alats::with('dataLabor')->get()
                                // ->where($,'<','10')
                                ->sum('stok');
            // dd($jumlahAlat);

            $dataBahan = Bahans::with('dataLabor')->get();
            $jumlahBahan = Bahans::with('dataLabor')->sum('stok');
            $dataPeminjaman = Peminjamans::with(['dataUser','dataAlat.dataLabor'])
                                            ->where('status','5')
                                            ->get();
            // dd($dataPeminjaman);

            $dataPeminjamanTerdekat = Peminjamans::with(['dataUser','dataAlat.dataLabor'])
                                            ->where('status','5')
                                            // ->Where('tgl_pengembalian','==', Carbon::now())
                                            ->Where('tgl_pengembalian','>', Carbon::now()->subDays(1))
                                            ->Where('tgl_pengembalian','<=', Carbon::now()->subDays(-10))
                                            ->orderBy('tgl_pengembalian','asc')
                                            ->get();
            // dd($dataPeminjamanTerdekat);
            // dd(Carbon::now()->subDays(-10));
            
            $dataPeminjamanTelat = Peminjamans::with(['dataUser','dataAlat.dataLabor'])
                                            ->where('status','5')
                                            ->where('tgl_pengembalian','<=', Carbon::now()->subDays(1))
                                            ->orderBy('tgl_pengembalian','asc')
                                            ->get();
            // dd($dataPeminjamanTelat);


            $jumlahPeminjaman = count($dataPeminjaman);
            // $jumlahPeminjaman = PeminjamanAlats::sum('jumlah');
            $dataPenggunaan = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->get();
            $jumlahPenggunaan = count($dataPenggunaan);
            // $jumlahPenggunaan = PenggunaanBahans::sum('jumlah');
            $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->get();
            $dataLog = Logs::with('dataUser')
                        ->where('user_id', Auth::user()->id)
                        ->orWhere('user_id', '!=', Auth::user()->id)
                        ->orderBy('id','DESC')->limit(5)->get();
        elseif (Auth::user()->role == "Laboran") :
            $dataAlat = Alats::with('dataLabor')->get();
            $jumlahAlat = Alats::with('dataLabor')->sum('stok');
            $dataBahan = Bahans::with('dataLabor')->get();
            $jumlahBahan = Bahans::with('dataLabor')->sum('stok');
            $dataPeminjaman = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->get();
            $jumlahPeminjaman = count($dataPeminjaman);
            $dataPenggunaan = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->get();
            $jumlahPenggunaan = count($dataPenggunaan);
            $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->get();
            // $dataLog = Logs::with('dataUser')->orderBy('id', 'DESC')->paginate(5);
            $dataLog = Logs::with('dataUser')
                        ->where('user_id',Auth::user()->id)
                        ->orWhere('category','Peminjaman')
                        ->orWhere('category','Penggunaan')
                        ->orderBy('id','DESC')->limit(5)->get();

            $dataPeminjamanTerdekat = Peminjamans::with(['dataUser','dataAlat.dataLabor'])
                                            ->where('status','5')
                                            // ->Where('tgl_pengembalian','==', Carbon::now())
                                            ->where('user_id',Auth::user()->id)
                                            ->Where('tgl_pengembalian','>', Carbon::now()->subDays(1))
                                            ->Where('tgl_pengembalian','<=', Carbon::now()->subDays(-10))
                                            ->orderBy('tgl_pengembalian','asc')
                                            ->get();
            // dd($dataPeminjamanTerdekat);
            // dd(Carbon::now()->subDays(-10));
            
            $dataPeminjamanTelat = Peminjamans::with(['dataUser','dataAlat.dataLabor'])
                                            ->where('status','5')
                                            ->where('user_id',Auth::user()->id)
                                            ->where('tgl_pengembalian','<=', Carbon::now()->subDays(1))
                                            ->orderBy('tgl_pengembalian','asc')
                                            ->get();
            // dd($dataPeminjamanTelat);
        else:
            $dataAlat = Alats::with('dataLabor')->get();
            $jumlahAlat = Alats::with('dataLabor')->sum('stok');
            $dataBahan = Bahans::with('dataLabor')->get();
            $jumlahBahan = Bahans::with('dataLabor')->sum('stok');
            $dataPeminjaman = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('user_id',Auth::user()->id)->get();
            $jumlahPeminjaman = count($dataPeminjaman);
            $dataPenggunaan = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->where('user_id',Auth::user()->id)->get();
            $jumlahPenggunaan = count($dataPenggunaan);
            $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('user_id',Auth::user()->id)->get();
            $dataLog = Logs::with('dataUser')
                            ->where('user_id',Auth::user()->id)
                            ->orderBy('id', 'DESC')->limit(5)->get();

            $dataPeminjamanTerdekat = Peminjamans::with(['dataUser','dataAlat.dataLabor'])
                                            ->where('status','5')
                                            // ->Where('tgl_pengembalian','==', Carbon::now())
                                            ->where('user_id',Auth::user()->id)
                                            ->Where('tgl_pengembalian','>', Carbon::now()->subDays(1))
                                            ->Where('tgl_pengembalian','<=', Carbon::now()->subDays(-10))
                                            ->orderBy('tgl_pengembalian','asc')
                                            ->get();
            // dd($dataPeminjamanTerdekat);
            // dd(Carbon::now()->subDays(-10));
            
            $dataPeminjamanTelat = Peminjamans::with(['dataUser','dataAlat.dataLabor'])
                                            ->where('status','5')
                                            ->where('user_id',Auth::user()->id)
                                            ->where('tgl_pengembalian','<=', Carbon::now()->subDays(1))
                                            ->orderBy('tgl_pengembalian','asc')
                                            ->get();
            // dd($dataPeminjamanTelat);
        endif;

        // dd($jumlahAlat);
        

        // $datas = Log::latest()->paginate(10);
        // $datasCounted = Log::latest()->take(5)->get();
        // return view('transactions.log.index', compact('datas'));
        
        return view('template.dashboard', compact('datas','dataAlat','dataBahan', 'jumlahAlat','jumlahBahan','dataPeminjaman','dataPenggunaan','dataLog','jumlahPeminjaman','jumlahPenggunaan','dataNotif','dataPeminjamanChart','dataPeminjamanPenggunaanChart','dataPenggunaanChart','dataDetailChart','dataPeminjamanTerdekat','dataPeminjamanTelat'));
        // return view('template.dashboard')
    }
    
    public function log()
    {
        $user = ['role' => Auth::user()->role, 'id' => Auth::user()->id];
        $dataNotif = MyLibrary::ambilNotif($user);

        if (Auth::user()->role == "Kepala Jurusan") :
            $dataLog = Logs::with('dataUser')
                        ->where('user_id', Auth::user()->id)
                        ->orWhere('user_id', '!=', Auth::user()->id)
                        ->orderBy('id','DESC')->get();
        elseif (Auth::user()->role == "Laboran") :
            $dataLog = Logs::with('dataUser')
                        ->where('user_id',Auth::user()->id)
                        ->orWhere('category','Peminjaman')
                        ->orWhere('category','Penggunaan')
                        ->orderBy('id','DESC')->get();
        else:
            $dataLog = Logs::with('dataUser')->where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        endif;

        // dd($dataLog);

        // $datas = Log::latest()->paginate(10);
        // $datasCounted = Log::latest()->take(5)->get();
        // return view('transactions.log.index', compact('datas'));
        
        return view('template.log', compact('dataLog','dataNotif'));
        // return view('template.dashboard')
    }
}
