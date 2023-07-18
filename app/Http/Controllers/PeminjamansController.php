<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Ramsey\Uuid\Uuid;
use App\Models\Peminjamans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeminjamansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->get();
        return view('main.peminjaman.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Peminjamans::with('dataUser')->get();
        $dataUser = Users::all();

        return view('main.peminjaman.form', compact('datas','dataUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'string|required|max:255',
            'kegiatan' => 'string|required|max:255',
            'tujuan' => 'string|required|max:255',
            'tgl_peminjaman' => 'date',
            'tgl_pengembalian' => 'date'
        ]);

        $validatedData['status'] = 'Menunggu Persetujuan';
        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;
        Peminjamans::create($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Peminjaman <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG

        // dd('$validatedData');

        return redirect('peminjaman')->with('flash_messaga','Peminjaman Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjamans  $peminjamans
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjamans $peminjamans, $uuid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjamans  $peminjamans
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjamans $peminjamans, $uuid)
    {
        $datas = Peminjamans::with(['dataAlat','dataUser'])->where("uuid", $uuid)->firstOrFail();
        $dataUser = Users::all();
        // dd($datas);

        return view('main.peminjaman.edit', compact('datas','dataUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjamans  $peminjamans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'user_id' => 'string|required|max:255',
            'kegiatan' => 'string|required|max:255',
            'tujuan' => 'string|required|max:255',
            'tgl_peminjaman' => 'date',
            'tgl_pengembalian' => 'date'
        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        Peminjamans::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Peminjaman <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/peminjaman')->with('success', 'Data Peminjaman Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjamans  $peminjamans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjamans $peminjamans, $uuid)
    {
        $data = Peminjamans::get()->where('uuid', $uuid)->firstOrFail();
        // $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Peminjaman <strong>[' . $data->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil dihapus!');
    }

    public function detail(Peminjamans $peminjamans, $uuid)
    {
        $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $uuid)->first();
        // $dataPeminjamanAlat = DB::table('peminjaman_alats')
                                // ->join('peminjamans','peminjaman_alats.peminjaman_id','=','peminjamans.id')
                                // ->select('peminjaman_alat.*','peminjaman.*')->get();
        $dataUser = Users::all();
        // dd($datas);
        // dd($dataPeminjamanAlat);
        return view('main.peminjaman.detail', compact('datas','dataUser'));
    }
}
