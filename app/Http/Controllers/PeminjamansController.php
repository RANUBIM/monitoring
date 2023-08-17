<?php

namespace App\Http\Controllers;

use App\MyLibrary;
use Carbon\Carbon;
use App\Models\Alats;
use App\Models\Users;
use Ramsey\Uuid\Uuid;
use App\Models\Peminjamans;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlats;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PeminjamansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Notif
        $user = ['role' => Auth::user()->role, 'id' => Auth::user()->id];
        $dataNotif = MyLibrary::ambilNotif($user);
        
        // $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->get();

        if (Auth::user()->role == "Kepala Jurusan" || Auth::user()->role == "Laboran") :
            $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->get();
        else:
            $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('user_id',Auth::user()->id)->get();
        endif;

        return view('main.peminjaman.index', compact('datas','dataNotif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = ['role' => Auth::user()->role, 'id' => Auth::user()->id];
        $dataNotif = MyLibrary::ambilNotif($user);

        $datas = Peminjamans::with('dataUser')->get();
        $dataUser = Users::all();

        return view('main.peminjaman.form', compact('datas','dataUser','dataNotif'));
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

        $validatedData['status'] = '1';
        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;
        Peminjamans::create($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Peminjaman <strong>[' . $request->kegiatan . ']</strong>', //name = nama tag di view (file index)
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
        $user = ['role' => Auth::user()->role, 'id' => Auth::user()->id];
        $dataNotif = MyLibrary::ambilNotif($user);

        $datas = Peminjamans::with(['dataAlat','dataUser'])->where("uuid", $uuid)->firstOrFail();
        $dataUser = Users::all();
        // dd($datas);

        return view('main.peminjaman.edit', compact('datas','dataUser','dataNotif'));
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
            'description' => '<em>Mengubah</em> data Peminjaman <strong>[' . $request->kegiatan . ']</strong>', //name = nama tag di view (file index)
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
        $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Peminjaman <strong>[' . $data->kegiatan . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('peminjaman.index')->with('delete','Data peminjaman berhasil dihapus');
    }

    public function detail(Peminjamans $peminjamans, $uuid)
    {
        $user = ['role' => Auth::user()->role, 'id' => Auth::user()->id];
        $dataNotif = MyLibrary::ambilNotif($user);

        $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $uuid)->first();
        // $dataPeminjamanAlat = DB::table('peminjaman_alats')
                                // ->join('peminjamans','peminjaman_alats.peminjaman_id','=','peminjamans.id')
                                // ->select('peminjaman_alat.*','peminjaman.*')->get();
        $dataUser = Users::all();

        // LOG
        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> data Peminjaman <strong>[' . $datas->kegiatan . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // /LOG

        // dd($datas);
        // dd($dataPeminjamanAlat);
        return view('main.peminjaman.detail', compact('datas','dataUser','dataNotif'));
    }
    
    public function peminjamanAlatCreate(Peminjamans $peminjamans, $uuid)
    {
        $user = ['role' => Auth::user()->role, 'id' => Auth::user()->id];
        $dataNotif = MyLibrary::ambilNotif($user);
        
        // $datas = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $uuid)->first();
        $datas = Peminjamans::with('dataUser')->where('uuid',$uuid)->first();
        $dataAlat = Alats::with('dataLabor')->get();

        return view('main.peminjaman.formPeminjamanAlat', compact('datas','dataAlat','dataNotif'));
    }

    public function peminjamanAlatStore(Request $request)
    {
        $dataAlat = Alats::with('dataLabor')->get()->where("id", $request->alat_id)->first();
        $tersedia = $dataAlat->stok - $dataAlat->dipinjam;
        // dd($dataAlat->stok);
        // dd($request->alat_id);

        $validatedData = $request->validate([
            'peminjaman_id' => 'string|required|max:255',
            'alat_id' => 'string|required|max:255',
            'jumlah' => 'numeric|min:1|max:'.$tersedia.'|required'
        ]);
        
        // dd($validatedData);

        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        DB::table('peminjaman_alats')->insert($validatedData);
        // Peminjamans::peminjamanAlatCreate($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data Peminjaman <strong>[' . $dataAlat->nama .' '. $dataAlat->spesifikasi .' - '. $request->jumlah .' '. $dataAlat->satuan . ']</strong>', //name = nama tag di view (file index)
            'category' => 'peminjaman',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG
        
        return redirect('/detail-peminjamanAlat/'.$request['uuid'])->with('success','Peminjaman Alat berhasil ditambah');
    }

    public function peminjamanAlatEdit(Peminjamans $peminjamans, Request $request, $uuid)
    {
        $user = ['role' => Auth::user()->role, 'id' => Auth::user()->id];
        $dataNotif = MyLibrary::ambilNotif($user);
        // dd($uuid);

        $validatedData = $request->validate([
            'namaUser' => 'string|required|max:255',
            'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidAlat' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedData);

        $datas = PeminjamanAlats::get()->where('uuid', $uuid)->first();
        $datass = Peminjamans::with(['dataAlat.dataLabor','dataUser'])->where("uuid", $uuid)->first();
        $dataAlat = Alats::with('dataLabor')->get();
        $dataUser = Users::get();
        // dd($datas);

        return view('main.peminjaman.editPeminjaman', compact('datas','datass','dataAlat','dataUser','validatedData','dataNotif'));
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
        // dd($validatedDataUUID);

        $dataAlat = Alats::with('dataLabor')->get()->where("id",$request->alat_id)->first();
        $tersedia = $dataAlat->stok - $dataAlat->dipinjam;
        // dd($dataAlat);

        $validatedData = $request->validate([
            // 'peminjaman_id' => 'string|required|max:255',
            'alat_id' => 'string|required|max:255',
            'jumlah' => 'numeric|min:1|required'
        ]);
        // dd($validatedData);

        if ($validatedData['jumlah'] > $tersedia):
            return redirect('/detail-peminjamanAlat/'.$validatedDataUUID['uuid'])->with('delete','Perubahan gagal, stok bahan tidak mencukupi');
        else:   
            DB::table('peminjaman_alats')->where('uuid', $uuid)->update($validatedData);

            $log = [
                'uuid' => Uuid::uuid4()->getHex(),
                'user_id' => Auth::user()->id,
                'description' => '<em>Mengubah</em> data Peminjaman <strong>[' . $dataAlat->nama .' '. $dataAlat->spesifikasi .' - '. $request->jumlah .' '. $dataAlat->satuan . ']</strong>', //name = nama tag di view (file index)
                'category' => 'peminjaman',
                'created_at' => now(),
            ];

            DB::table('logs')->insert($log);
            // selesai

            return redirect('/detail-peminjamanAlat/'.$validatedDataUUID['uuid'])->with('success','Peminjaman Alat berhasil diubah');
        endif;
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
        $dataAlat = Alats::with('dataLabor')->get()->where("uuid",$validatedData['uuidAlat'])->first();

        // dd($validatedData);

        // $dataLog = Peminjamans::with('dataAlat')->where('', $uuid)
        // $data->deleted_by = Auth::user()->id;
        // $data->save();

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data Peminjaman <strong>[' . $dataAlat->nama .' '. $dataAlat->spesifikasi .' - '. $data->jumlah .' '. $dataAlat->satuan . ']</strong>', //name = nama tag di view (file index)
            'category' => 'peminjaman',
            'created_at' => now(),
        ];
        DB::table('logs')->insert($log);

        // dd($data);
        DB::table('peminjaman_alats')->where('uuid', $validatedData['uuidPivot'])->delete();

        return redirect('/detail-peminjamanAlat/'.$validatedData['uuid'])->with('delete','Peminjaman Alat berhasil dihapus');
    }

    public function peminjamanAlatStatus1(Peminjamans $peminjamans, Request $request, $uuid)
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

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);
        
        $data = Peminjamans::with('dataUser','dataAlat')->where('uuid', $uuid)->first();
        // dd($data->dataUser->nama);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => $data->dataUser->id,
            'description' => '<strong>[' . Auth::user()->nama . ']</strong> <em>Mengubah</em> status peminjaman <strong>[Menunggu penyetujuan peminjaman]</strong>', //name = nama tag di view (file index)
            'category' => 'Peminjaman',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        return redirect('/peminjaman')->with('success','Status Peminjaman alat berhasil diubah');
    }

    public function peminjamanAlatStatus2(Peminjamans $peminjamans, Request $request, $uuid)
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

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        $data = Peminjamans::with('dataUser','dataAlat')->where('uuid', $uuid)->first();
        // dd($data->dataUser->nama);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => $data->dataUser->id,
            'description' => '<strong>[' . Auth::user()->nama . ']</strong> <em>Mengubah</em> status peminjaman <strong>[ Menunggu Penyediaan ]</strong>', //name = nama tag di view (file index)
            'category' => 'Peminjaman',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        return redirect('/peminjaman')->with('success','Status Peminjaman alat berhasil diubah');
    }
    
    // public function peminjamanAlatStatus3(Peminjamans $peminjamans, Request $request, $uuid)
    // {
    //     $validatedDataUUID = $request->validate([
    //         // 'namaUser' => 'string|required|max:255',
    //         // 'namaAlat' => 'string|required|max:255',
    //         'uuid' => 'string|required|max:255',
    //         // 'uuidAlat' => 'string|required|max:255',
    //         // 'uuidPivot' => 'string|required|max:255'
    //     ]);
    //     // dd($validatedDataUUID);
        
    //     $validatedData['status'] = "4";
    //     // dd($validatedData);

    //     DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

    //     // $log = [
    //     //     'uuid' => Uuid::uuid4()->getHex(),
    //     //     'user_id' => Auth::user()->id,
    //     //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
    //     //     'category' => 'edit',
    //     //     'created_at' => now(),
    //     // ];

    //     // DB::table('logs')->insert($log);
    //     // // selesai

    //     return redirect('/peminjaman')->with('success','Peminjaman Added');
    // }
    
    public function peminjamanAlatCheck(Peminjamans $peminjamans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            'namaUser' => 'string|required|max:255',
            'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidAlat' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        $data = PeminjamanAlats::get()->where('uuid', $uuid)->first();
        // dd($data);

        $dataAlat = Alats::with('dataLabor')->get()->where('uuid', $request->uuidAlat)->first();
        $kurangStok = $dataAlat->dipinjam + $data->jumlah;
        // dd($kurangStok);
        $validateUpdateStok['dipinjam'] = $kurangStok;
        Alats::where("uuid", $dataAlat->uuid)->update($validateUpdateStok);
        
        $validateUpdateStatus['status'] = "1";
        DB::table('peminjaman_alats')->where("uuid", $validatedDataUUID['uuidPivot'])->update($validateUpdateStatus);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/detail-peminjamanAlat/'.$validatedDataUUID['uuid'])->with('success','Peminjaman Added');
    }

    public function peminjamanAlatKondisiPeminjaman(Peminjamans $peminjamans, Request $request, $uuid)
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

        $validatedData['kondisi_peminjaman'] = $request->kondisi_peminjaman;
        $validatedData['status'] = "4";
        // dd($validatedData);

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/peminjaman')->with('success','Peminjaman Added');
    }
    
    public function peminjamanAlatStatus3(Peminjamans $peminjamans, Request $request, $uuid)
    {
        // dd("tes pindah");

        $validatedDataUUID = $request->validate([
            'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'peminjaman_id' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'kondisi_peminjaman' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        // $data = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $request->uuid)->first();
        $datas = PeminjamanAlats::get()->where('peminjaman_id', $validatedDataUUID['peminjaman_id']);
        // dd($datas);
        
        foreach ($datas as $show){
            // echo $show->id;
            // dd($show->peminjaman_id);
            
            $dataAlat = Alats::with('dataLabor')->get()->where('id', $show->alat_id)->first();
            // echo $dataAlat;
            
            $kurangStok = $dataAlat->dipinjam + $show->jumlah;
            $validateUpdateStok['dipinjam'] = $kurangStok;
            Alats::where("id", $show->alat_id)->update($validateUpdateStok);
            
            $validateUpdateStatus['status'] = "1";
            DB::table('peminjaman_alats')->where("id", $show['id'])->update($validateUpdateStatus);
        }
        // dd($show);

        $validatedData['kondisi_peminjaman'] = $validatedDataUUID['kondisi_peminjaman'];
        $validatedData['status'] = "4";
        // dd($validatedData);

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        $data = Peminjamans::with('dataUser','dataAlat')->where('uuid', $uuid)->first();
        // dd($data->dataUser->nama);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => $data->dataUser->id,
            'description' => '<strong>[' . Auth::user()->nama . ']</strong> <em>Mengubah</em> status peminjaman <strong>[Alat Dapat Diambil]</strong>', //name = nama tag di view (file index)
            'category' => 'Peminjaman',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        return redirect('/peminjaman')->with('success','Status Peminjaman alat berhasil diubah');
    }

    public function peminjamanAlatStatus4(Peminjamans $peminjamans, Request $request, $uuid)
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

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        $data = Peminjamans::with('dataUser','dataAlat')->where('uuid', $uuid)->first();
        // dd($data->dataUser->nama);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => $data->dataUser->id,
            'description' => '<strong>[' . Auth::user()->nama . ']</strong> <em>Mengubah</em> status peminjaman <strong>[Alat Dipinjam]</strong>', //name = nama tag di view (file index)
            'category' => 'Peminjaman',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        return redirect('/peminjaman')->with('success','Status Peminjaman alat berhasil diubah');
    }

    // ALUR PENGEMBALIAN 
    public function peminjamanAlatStatus5(Peminjamans $peminjamans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        $validatedData['status'] = "6";
        // dd($validatedData);

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        $data = Peminjamans::with('dataUser','dataAlat')->where('uuid', $uuid)->first();
        // dd($data->dataUser->nama);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => $data->dataUser->id,
            'description' => '<strong>[' . Auth::user()->nama . ']</strong> <em>Mengubah</em> status peminjaman <strong>[Menunggu Penyetujuan Pengembalian]</strong>', //name = nama tag di view (file index)
            'category' => 'Peminjaman',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        return redirect('/peminjaman')->with('success','Status Peminjaman alat berhasil diubah');
    }

    public function peminjamanAlatStatus6(Peminjamans $peminjamans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        $validatedData['status'] = "7";
        // dd($validatedData);

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        $data = Peminjamans::with('dataUser','dataAlat')->where('uuid', $uuid)->first();
        // dd($data->dataUser->nama);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => $data->dataUser->id,
            'description' => '<strong>[' . Auth::user()->nama . ']</strong> <em>Mengubah</em> status peminjaman <strong>[Proses Pengecekan Alat]</strong>', //name = nama tag di view (file index)
            'category' => 'Peminjaman',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        return redirect('/peminjaman')->with('success','Status Peminjaman alat berhasil diubah');
    }

    public function pengembalianAlatCheck(Peminjamans $peminjamans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            'namaUser' => 'string|required|max:255',
            'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'uuidAlat' => 'string|required|max:255',
            'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        $data = PeminjamanAlats::get()->where('uuid', $uuid)->first();
        // dd($data);

        $dataAlat = Alats::with('dataLabor')->get()->where('uuid', $request->uuidAlat)->first();
        $kurangStok = $dataAlat->dipinjam - $data->jumlah;
        // dd($kurangStok);
        $validateUpdateStok['dipinjam'] = $kurangStok;
        Alats::where("uuid", $dataAlat->uuid)->update($validateUpdateStok);
        
        $validateUpdateStatus['status'] = "2";
        DB::table('peminjaman_alats')->where("uuid", $validatedDataUUID['uuidPivot'])->update($validateUpdateStatus);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/detail-peminjamanAlat/'.$validatedDataUUID['uuid'])->with('success','Status Peminjaman alat berhasil diubah');
    }

    public function peminjamanAlatKondisiPengembalian(Peminjamans $peminjamans, Request $request, $uuid)
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

        $validatedData['kondisi_pengembalian'] = $request->kondisi_pengembalian;
        $validatedData['status'] = "7";
        // dd($validatedData);

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        $data = Peminjamans::with('dataUser','dataAlat')->where('uuid', $uuid)->first();
        // dd($data->dataUser->nama);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => $data->dataUser->id,
            'description' => '<strong>[' . Auth::user()->nama . ']</strong> <em>Mengubah</em> status peminjaman <strong>[Proses Pengecekan Alat]</strong>', //name = nama tag di view (file index)
            'category' => 'Peminjaman',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        return redirect('/peminjaman')->with('success','Status Peminjaman alat berhasil diubah');
    }

    public function peminjamanAlatStatus7(Peminjamans $peminjamans, Request $request, $uuid)
    {
        // dd("tes pindah");

        $validatedDataUUID = $request->validate([
            'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'peminjaman_id' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            'kondisi_pengembalian' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);
        
        // $data = Peminjamans::with(['dataUser','dataAlat.dataLabor'])->where('uuid', $request->uuid)->first();
        $datas = PeminjamanAlats::get()->where('peminjaman_id', $validatedDataUUID['peminjaman_id']);
        // dd($datas);
        
        foreach ($datas as $show){
            // echo $show->id;
            // dd($show->peminjaman_id);
            
            $dataAlat = Alats::with('dataLabor')->get()->where('id', $show->alat_id)->first();
            // echo $dataAlat;
            
            $kurangStok = $dataAlat->dipinjam - $show->jumlah;
            $validateUpdateStok['dipinjam'] = $kurangStok;
            Alats::where("id", $show->alat_id)->update($validateUpdateStok);
            
            $validateUpdateStatus['status'] = "2";
            DB::table('peminjaman_alats')->where("id", $show['id'])->update($validateUpdateStatus);
        }
        // dd($show);

        $validatedData['kondisi_pengembalian'] = $validatedDataUUID['kondisi_pengembalian'];
        $validatedData['status'] = "8";
        // dd($validatedData);

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        $data = Peminjamans::with('dataUser','dataAlat')->where('uuid', $uuid)->first();
        // dd($data->dataUser->nama);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => $data->dataUser->id,
            'description' => '<strong>[' . Auth::user()->nama . ']</strong> <em>Mengubah</em> status peminjaman <strong>[Alat Dikembalikan]</strong>', //name = nama tag di view (file index)
            'category' => 'Peminjaman',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // /LOG

        return redirect('/peminjaman')->with('success','Status Peminjaman alat berhasil diubah');
    }

    

    public function peminjamanAlatStatusTolak(Peminjamans $peminjamans, Request $request, $uuid)
    {
        $validatedDataUUID = $request->validate([
            // 'namaUser' => 'string|required|max:255',
            // 'namaAlat' => 'string|required|max:255',
            'uuid' => 'string|required|max:255',
            // 'uuidAlat' => 'string|required|max:255',
            // 'uuidPivot' => 'string|required|max:255'
        ]);
        // dd($validatedDataUUID);

        $validatedData['status'] = "tolak";
        $validatedData['kondisi_peminjaman'] = $request->kondisi_peminjaman;
        
        // $validatedData['status'] = "2";
        // dd($validatedData);

        DB::table('peminjamans')->where('uuid', $uuid)->update($validatedData);

        // $log = [
        //     'uuid' => Uuid::uuid4()->getHex(),
        //     'user_id' => Auth::user()->id,
        //     'description' => '<em>Mengubah</em> Status data Peminjaman Alat <strong>[' . $request->nama . ']</strong>', //name = nama tag di view (file index)
        //     'category' => 'edit',
        //     'created_at' => now(),
        // ];

        // DB::table('logs')->insert($log);
        // // selesai

        return redirect('/peminjaman')->with('delete','Status Peminjaman ditolak');
    }
}
