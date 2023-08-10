<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Alats;
use Ramsey\Uuid\Uuid;
use App\Models\Labors;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// use App

class AlatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        // $datas = Alats::with('dataLabor');
        $datas = Alats::with('dataLabor')->get();

        // $datas = DB::table('alats')->get();
        // $datas = DB::table('alats.*','labors.*')
                        // ->where('alats.deleted_by',null)
                        // ->join('labors','labors.id','=','alats.labor_id')->get();
        // dd($datas);

        // $labor_id =  $request->get('$labor_id');
        // $nama =  $request->get('$nama');
        // $spesifikasi =  $request->get('$spesifikasi');
        // $stok =  $request->get('$stok');
        // $keterangan =  $request->get('$keterangan');

        // dd($datas);
        return view('masters.alat.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Alats::all();
        $dataLabor = Labors::all();

        return view('masters.alat.form', compact('datas','dataLabor'));
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
        $validatedData['created_by'] = Auth::user()->id;
        Alats::create($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG

        // dd('$validatedData');

        return redirect('alat')->with('success','Data alat berhasil ditambah');
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
        $datas = Alats::where('uuid', $uuid)->where("uuid", $uuid)->first();
        $dataLabor = Labors::all();

        return view('masters.alat.edit', compact('datas','dataLabor'));
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
        $validatedData['updated_by'] = Auth::user()->id;

        Alats::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/alat')->with('success', 'Data alat berhasil diubah');
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
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Alat <strong>[' . $data->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('alat.index')->with('delete', 'Data alat berhasil dihapus');
    }

    public function printAlat(request $request)
    {
        $datas = Alats::with('dataLabor')->get();

        
        // $datas = DB::table('alats')->get();
        // $datas = DB::table('alats.*','labors.*')
        // ->where('alats.deleted_by',null)
        // ->join('labors','labors.id','=','alats.labor_id')->get();
        // dd($datas);
        
        // print halaman
        // $pdf = Pdf::loadView('pdf.print-alat', ['datas'=>$datas]);
        // return $pdf->download('Data Alat'.Carbon::now()->timestamp.'.pdf');

        // lihat halaman
        return view('pdf.print-alat', compact('datas'));
    }
}
