<?php

namespace App\Http\Controllers;

use App\Models\Alats;
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

        return redirect('/peminjaman')->with('success','Data peminjaman berhasil ditambah');
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


        return redirect('/peminjaman')->with('success','Data peminjaman berhasil diubah');
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

        return redirect()->route('peminjaman.index')->with('delete','Data peminjaman berhasil dihapus');
    }

    public function detail(Peminjamans $peminjamans, $uuid)
    {
        $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $uuid)->first();
        // $dataPeminjamanAlat = DB::table('peminjaman_alats')
                                // ->join('peminjamans','peminjaman_alats.peminjaman_id','=','peminjamans.id')
                                // ->select('peminjaman_alat.*','peminjaman.*')->get();
        $dataUser = Users::all();

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Peminjaman <strong>[' . $datas->kegiatan . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        // dd($datas);
        // dd($dataPeminjamanAlat);
        return view('main.peminjaman.detail', compact('datas','dataUser'));
    }
    
    public function peminjamanAlatCreate(Peminjamans $peminjamans, $uuid)
    {
        // $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $uuid)->first();
        $datas = Peminjamans::with('dataUser')->where('uuid',$uuid)->first();
        // $dataUser = Users::get();
        $dataAlat = Alats::with('dataLabor')->get();

        return view('main.peminjaman.formPeminjamanAlat', compact('datas','dataAlat'));
    }

    public function peminjamanAlatStore(Request $request)
    {
        $validatedData = $request->validate([
            'peminjaman_id' => 'string|required|max:255',
            'alat_id' => 'string|required|max:255',
            'jumlah' => 'integer|required|max:255'
        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        DB::table('peminjaman_alats')->insert($validatedData);
        // Peminjamans::peminjamanAlatCreate($validatedData);

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
        
        return redirect('/detail-peminjamanAlat/'.$request['uuid'])->with('flash_messaga','Peminjaman Added');
    }

    public function peminjamanAlatEdit(Peminjamans $peminjamans, Request $request, $uuid)
    {
        // dd($uuid);
        $validatedData = $request->validate([
            'namaUser' => 'string|required|max:255',
            'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidAlat' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);

        // dd($validatedData);

        $datas = DB::table('peminjaman_alats')->get()->where('uuid', $uuid)->first();
        $datass = Peminjamans::with(['dataAlat.dataLabor','dataUser'])->where("uuid", $uuid)->first();
        $dataAlat = Alats::with('dataLabor')->get();
        $dataUser = Users::get();
        // dd($datas);

        return view('main.peminjaman.editPeminjaman', compact('datas','datass','dataAlat','dataUser','validatedData'));
    }

    public function peminjamanAlatUpdate(Peminjamans $peminjamans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidAlat' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);

        $validatedData = $request->validate([
            // 'peminjaman_id' => 'string|required|max:255',
            'alat_id' => 'string|required|max:255',
            'jumlah' => 'string|required|max:255',
        ]);
        
        // dd($validatedData);

        DB::table('peminjaman_alats')->where('uuid', $uuid)->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return redirect('/detail-peminjamanAlat/'.$validatedDataUUID['uuid'])->with('success','Peminjaman Added');
    }

    public function peminjamanAlatUpdateCadangan(Peminjamans $peminjamans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            'namaUser' => 'string|required|max:255',
            'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidAlat' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);

        $validatedData = $request->validate([
            // 'peminjaman_id' => 'string|required|max:255',
            // 'alat_id' => 'string|required|max:255',
            'jumlah' => 'string|required|max:255',
        ]);
        // $validatedData['updated_by'] = Auth::user()->id;
        // dd($validatedData);
        dd("tes");

        // DB::table('peminjaman_alats')->where('uuid', $uuid)->update($validatedData);

        // $dataJumlah = Alats::get()->where('id', $validatedData['alat_id'])->first();
        // $hitungJumlah = $dataJumlah['jumlah'] - $validatedData['jumlah'];
        // dd($hitungJumlah);

        // Peminjamans::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        // return redirect('/peminjaman')->with('success', 'Data Peminjaman Berhasil Diupdate !!');
        // dd($validatedDataUUID);
        // dd($validatedData);
        // return redirect('/detail-peminjamanAlat/'.$validatedDataUUID['uuid'])->with('success','Peminjaman Added');
    }

    public function peminjamanAlatDestroy(Request $request, $uuid)
    {
        // $data = Peminjamans::get()->where('uuid', $uuid)->firstOrFail();
        $validatedData = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidAlat' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);
        
        $data = DB::table('peminjaman_alats')->get()->where('uuid', $validatedData['uuidPivot'])->first();

        // dd($validatedData);

        // $dataLog = Peminjamans::with('dataAlat')->where('', $uuid)
        // $data->deleted_by = Auth::user()->id;
        // $data->save();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Peminjaman Alat <strong>[' . $validatedData['namaAlat'] . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];
        DB::table('logs')->insert($log);

        // dd($data);
        DB::table('peminjaman_alats')->where('uuid', $validatedData['uuidPivot'])->delete();

        return redirect('/detail-peminjamanAlat/'.$validatedData['uuid'])->with('delete','Peminjaman Added');
    }
}
