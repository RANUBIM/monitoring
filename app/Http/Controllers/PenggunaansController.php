<?php

namespace App\Http\Controllers;

use App\Models\Bahans;
use App\Models\PenggunaanBahans;
use App\Models\Users;
use Ramsey\Uuid\Uuid;
use App\Models\Penggunaans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenggunaansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->get();

        if (Auth::user()->role == "Kepala Jurusan" || Auth::user()->role == "Laboran") :
            $datas = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->get();
        else :
            $datas = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->where('user_id',Auth::user()->id)->get();
        endif;
        // dd($datas);

        return view('main.penggunaan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Penggunaans::with('dataUser')->get();
        $dataUser = Users::all();

        return view('main.penggunaan.form', compact('datas','dataUser'));
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
            'tgl_permintaan' => 'date',
            // 'note' => 'string|required|max:255'
        ]);

        $validatedData['status'] = '1';
        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;
        Penggunaans::create($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data penggunaan <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG

        // dd('$validatedData');

        return redirect('/penggunaan')->with('success','Data penggunaan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penggunaans  $penggunaans
     * @return \Illuminate\Http\Response
     */
    public function show(Penggunaans $penggunaans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penggunaans  $penggunaans
     * @return \Illuminate\Http\Response
     */
    public function edit(Penggunaans $penggunaans, Request $request, $uuid)
    {
        $datas = Penggunaans::with(['dataUser'])->where("uuid", $uuid)->first();
        $dataUser = Users::all();
        // dd($datas);

        return view('main.penggunaan.edit', compact('datas','dataUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penggunaans  $penggunaans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penggunaans $penggunaans, $uuid)
    {
        $validatedData = $request->validate([
            'user_id' => 'string|required|max:255',
            'kegiatan' => 'string|required|max:255',
            'tujuan' => 'string|required|max:255',
            'tgl_permintaan' => 'date',
        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        Penggunaans::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Penggunaan <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/penggunaan')->with('success','Data penggunaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penggunaans  $penggunaans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penggunaans $penggunaans, $uuid)
    {
        $data = Penggunaans::get()->where('uuid', $uuid)->firstOrFail();
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Penggunaan <strong>[' . $data->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('penggunaan.index')->with('delete','Data penggunaan berhasil dihapus');
    }

    public function detail(Penggunaans $penggunaans, $uuid)
    {
        $datas = Penggunaans::with(['dataUser','dataBahan.dataLabor'])->where('uuid', $uuid)->first();
        // $dataPeminjamanAlat = DB::table('peminjaman_alats')
                                // ->join('peminjamans','peminjaman_alats.peminjaman_id','=','peminjamans.id')
                                // ->select('peminjaman_alat.*','peminjaman.*')->get();
        $dataUser = Users::all();

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Melihat</em> detail data Penggunaan <strong>[' . $datas->kegiatan . ']</strong>', //name = nama tag di view (file index)
            'category' => 'detail',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        // dd($datas);
        // dd($dataPeminjamanAlat);
        return view('main.penggunaan.detail', compact('datas','dataUser'));
    }

    public function penggunaanBahanCreate(Penggunaans $penggunaans, $uuid)
    {
        // $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $uuid)->first();
        $datas = Penggunaans::with('dataUser')->where('uuid',$uuid)->first();
        // $dataUser = Users::get();
        $dataBahan = Bahans::with('dataLabor')->get();

        return view('main.penggunaan.formPenggunaanBahan', compact('datas','dataBahan'));
    }

    public function penggunaanBahanStore(Request $request)
    {   
        $validatedData = $request->validate([
            'penggunaan_id' => 'string|required|max:255',
            'bahan_id' => 'string|required|max:255',
            'jumlah' => 'integer|required|max:255'
        ]);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        DB::table('penggunaan_bahans')->insert($validatedData);
        // Peminjamans::peminjamanAlatCreate($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Penggunaan <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG
        
        return redirect('/detail-penggunaanBahan/'.$request['uuid'])->with('flash_messaga','Peminjaman Added');
    }

    public function penggunaanBahanEdit(Penggunaans $penggunaans, Request $request, $uuid)
    {
        // dd("Masuk Ke EDIT");

        $validatedData = $request->validate([
            'namaUser' => 'string|required|max:255',
            'namaBahan' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidBahan' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);

        // dd($validatedData);

        $datas = DB::table('penggunaan_bahans')->get()->where('uuid', $uuid)->first();
        $datass = Penggunaans::with(['dataBahan.dataLabor','dataUser'])->where("uuid", $uuid)->first();
        $dataBahan = Bahans::with('dataLabor')->get();
        $dataUser = Users::get();
        // dd($datas);

        return view('main.penggunaan.editPenggunaan', compact('datas','datass','dataBahan','dataUser','validatedData'));
    }

    public function penggunaanBahanUpdate(Penggunaans $penggunaans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidBahan' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);

        $validatedData = $request->validate([
            // 'peminjaman_id' => 'string|required|max:255',
            'bahan_id' => 'string|required|max:255',
            'jumlah' => 'string|required|max:255',
        ]);
        // dd($validatedData);

        DB::table('penggunaan_bahans')->where('uuid', $uuid)->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data Penggunaan Bahan <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai

        return redirect('/detail-penggunaanBahan/'.$validatedDataUUID['uuid'])->with('success','Peminjaman Added');
    }

    public function penggunaanBahanDestroy(Request $request, $uuid)
    {
        // $data = Peminjamans::get()->where('uuid', $uuid)->firstOrFail();
        $validatedData = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            'namaBahan' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidBahan' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedData);

        $data = DB::table('penggunaan_bahans')->get()->where('uuid', $validatedData['uuidPivot'])->first();
        // $data->deleted_by = Auth::user()->id;
        // $data->save();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Penggunaan Bahan <strong>[' . $validatedData['namaBahan'] . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];
        DB::table('logs')->insert($log);

        // dd($data);
        DB::table('penggunaan_bahans')->where('uuid', $validatedData['uuidPivot'])->delete();

        return redirect('/detail-penggunaanBahan/'.$validatedData['uuid'])->with('delete','Penggunaan Bahan hapus');
    }

    public function penggunaanBahanStatus1(Penggunaans $penggunaans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        $validatedData['status'] = "2";
        // dd($validatedData);

        DB::table('penggunaans')->where('uuid', $uuid)->update($validatedData);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/penggunaan')->with('success','Penggunaan Added');
    }

    public function penggunaanBahanStatus2(Penggunaans $penggunaans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        $validatedData['status'] = "3";
        // dd($validatedData);

        DB::table('penggunaans')->where('uuid', $uuid)->update($validatedData);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/penggunaan')->with('success','Peminjaman Added');
    }

    public function penggunaanBahanCheck(Penggunaans $penggunaans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            'namaUser' => 'string|required|max:255',
            'namaBahan' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidBahan' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        $data = PenggunaanBahans::get()->where('uuid', $uuid)->first();
        // dd($data);

        $dataBahan = Bahans::with('dataLabor')->get()->where('uuid', $request->uuidBahan)->first();
        $kurangStok = $dataBahan->digunakan + $data->jumlah;
        // dd($kurangStok);

        $validateUpdateStok['digunakan'] = $kurangStok;
        Bahans::where("uuid", $dataBahan->uuid)->update($validateUpdateStok);
        
        $validateUpdateStatus['status'] = "1";
        DB::table('penggunaan_bahans')->where("uuid", $validatedDataUUID['uuidPivot'])->update($validateUpdateStatus);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/detail-penggunaanBahan/'.$validatedDataUUID['uuid'])->with('success','Peminjaman Added');
    }

    public function penggunaanBahanNote(Penggunaans $penggunaans, Request $request, $uuid)
    {
        // dd("tes pindah");

        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);

        $validatedData['note'] = $request->note;
        $validatedData['status'] = "4";
        // dd($validatedData);

        DB::table('penggunaans')->where('uuid', $uuid)->update($validatedData);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/penggunaan')->with('success','Penggunaan Added');
    }

    public function penggunaanBahanStatus3(Penggunaans $penggunaans, Request $request, $uuid)
    {
        // dd("tes pindah");

        $validatedDataUUID = $request->validate([
            'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'penggunaan_id' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'note' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        // $data = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $request->uuid)->first();
        $datas = PenggunaanBahans::get()->where('penggunaan_id', $validatedDataUUID['penggunaan_id']);
        // dd($datas);
        
        foreach ($datas as $show){
            // echo $show->id;
            
            $dataBahan = Bahans::with('dataLabor')->get()->where('id', $show->bahan_id)->first();
            // echo $dataBahan;
            
            $kurangStok = $dataBahan->digunakan + $show->jumlah;
            $validateUpdateStok['digunakan'] = $kurangStok;
            Bahans::where("id", $show->bahan_id)->update($validateUpdateStok);
            
            $validateUpdateStatus['status'] = "1";
            DB::table('penggunaan_bahans')->where("id", $show['id'])->update($validateUpdateStatus);
        }
        // dd($show);

        $validatedData['note'] = $validatedDataUUID['note'];
        $validatedData['status'] = "4";
        // dd($validatedData);

        DB::table('penggunaans')->where('uuid', $uuid)->update($validatedData);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/penggunaan')->with('success','Penggunaan Added');
    }

    public function penggunaanBahanStatus4(Penggunaans $penggunaans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        $validatedData['status'] = "5";
        // dd($validatedData);

        DB::table('penggunaans')->where('uuid', $uuid)->update($validatedData);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/penggunaan')->with('success','Penggunaan Added');
    }

    public function penggunaanBahanStatusTolak(Penggunaans $penggunaans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);

        $validatedData['status'] = $request->status;
        
        // $validatedData['status'] = "2";
        // dd($validatedData);

        DB::table('penggunaans')->where('uuid', $uuid)->update($validatedData);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/penggunaan')->with('success','Penggunaan Added');
    }
}
