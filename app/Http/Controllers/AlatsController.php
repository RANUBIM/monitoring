<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Ramsey\Uuid\Uuid;
use App\Models\Alats;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Alats::all();
        return view('masters.alat.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Alats::first();

        return view('masters.alat.form', compact('datas'));
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
            'labor_id' => 'string|required|max:255',
            'nama' => 'string|required|max:255',
            'spesifikasi' => 'string|required|max:255',
            'stok' => 'string|required|max:255',
            'satuan' => 'string|required|max:255',
            'keterangan' => 'string|required|max:255'
        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = "1";
        // $validatedData['created_by'] = Auth::user()->id;
        Alats::create($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Alat <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG

        // dd('$validatedData');

        return redirect('alat')->with('flash_messaga','Alat Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alats  $alats
     * @return \Illuminate\Http\Response
     */
    public function show(Alats $alats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alats  $alats
     * @return \Illuminate\Http\Response
     */
    public function edit(Alats $alats, $uuid)
    {
        $datas = Alats::where('uuid', $uuid)->get();
        return view('masters.alat.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alats  $alats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'labor_id' => 'string|required|max:255',
            'nama' => 'string|required|max:255',
            'spesifikasi' => 'string|required|max:255',
            'stok' => 'string|required|max:255',
            'satuan' => 'string|required|max:255',
            'keterangan' => 'string|required|max:255'
        ]);
        // $validatedData['updated_by'] = Auth::user()->id;
        $validatedData['updated_by'] = "1";

        Alats::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Alat <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/alat')->with('success', 'Data Alat Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alats  $alats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alats $alats, $uuid)
    {
        $data = Alats::get()->where('uuid', $uuid)->firstOrFail();
        // $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Alat <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('alat.index')->with('success', 'Data berhasil dihapus!');
    }
}
