<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

use App\Models\Bahans;
use App\Models\Labors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BahansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Bahans::with('dataLabor')->get();
        return view('masters.bahan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Bahans::all();
        $dataLabor = Labors::all();

        return view('masters.bahan.form', compact('datas','dataLabor'));
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
            'no_inv' => 'string|required|max:255',
            'tgl_pengadaan' => 'string|required|max:255',
            'labor_id' => 'string|required|max:255',
            'nama' => 'string|required|max:255',
            'spesifikasi' => 'string|required|max:255',
            'stok' => 'string|required|max:255',
            'satuan' => 'string|required|max:255',
            'keterangan' => 'string|required|max:255'
        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        // $validatedData['created_by'] = "1";
        $validatedData['created_by'] = Auth::user()->id;
        Bahans::create($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Bahan <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG

        // dd('$validatedData');

        return redirect('bahan')->with('success','Data bahan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bahans  $bahans
     * @return \Illuminate\Http\Response
     */
    public function show(Bahans $bahans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bahans  $bahans
     * @return \Illuminate\Http\Response
     */
    public function edit(Bahans $bahans, $uuid)
    {
        $datas = Bahans::where('uuid', $uuid)->where("uuid", $uuid)->first();
        $dataLabor = Labors::all();

        return view('masters.bahan.edit', compact('datas','dataLabor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bahans  $bahans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'no_inv' => 'string|required|max:255',
            'tgl_pengadaan' => 'string|required|max:255',
            'labor_id' => 'string|required|max:255',
            'nama' => 'string|required|max:255',
            'spesifikasi' => 'string|required|max:255',
            'stok' => 'string|required|max:255',
            'satuan' => 'string|required|max:255',
            'keterangan' => 'string|required|max:255'
        ]);
        $validatedData['updated_by'] = Auth::user()->id;
        // $validatedData['updated_by'] = "1";

        Bahans::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Bahan <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/bahan')->with('success', 'Data bahan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bahans  $bahans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bahans $bahans, $uuid)
    {
        $data = Bahans::get()->where('uuid', $uuid)->firstOrFail();
        // $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Bahan <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('bahan.index')->with('delete', 'Data bahan berhasil dihapus');
    }
}
