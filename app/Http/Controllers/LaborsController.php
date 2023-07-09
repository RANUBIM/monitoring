<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Ramsey\Uuid\Uuid;
use App\Models\Labors;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaborsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Labors::all();
        return view('masters.labor.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Labors::first();

        return view('masters.labor.form', compact('datas'));
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
            'name' => 'string|required|max:255'
        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        // $validatedData['created_by'] = Auth::user()->id;
        Labors::create($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Labor <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG

        return redirect('labor')->with('flash_messaga','Labor Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Labors  $labors
     * @return \Illuminate\Http\Response
     */
    public function show(Labors $labors)
    {
        $labor = Labors::find($id);
        return view('labor.show')->with('labor', $labor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Labors  $labors
     * @return \Illuminate\Http\Response
     */
    public function edit(Labors $labors, $uuid)
    {
        $datas = Labors::where('uuid', $uuid)->get();

        
        return view('masters.labor.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Labors  $labors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'name' => 'string|required|max:255'

        ]);
        // $validatedData['updated_by'] = Auth::user()->id;

        Labors::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Labor <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/labor')->with('success', 'Data Labor Berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Labors  $labors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Labors $labors, $uuid)
    {
        $data = Labors::get()->where('uuid', $uuid)->firstOrFail();
        // $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Labor <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('labor.index')->with('success', 'Data berhasil dihapus!');
    }
}
