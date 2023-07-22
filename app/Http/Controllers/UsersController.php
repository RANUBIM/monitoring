<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Ramsey\Uuid\Uuid;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Users::all();
        return view('masters.user.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Users::first();

        return view('masters.user.form', compact('datas'));
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
            'niknis' => 'string|required|max:255|min:5',
            'password' => 'string|required|max:255',
            'role' => 'string|required|max:255',
            'nama' => 'string|required|max:255',
            'kelas' => 'string|max:255',
            'jurusan' => 'string|max:255',
            'mapel' => 'string|max:255',
            'kontak' => 'string|required|max:255',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['uuid'] = Uuid::uuid4()->getHex();
        $validatedData['created_by'] = Auth::user()->id;

        Users::create($validatedData);

        // LOG
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            'user_id' => Auth::user()->id,
            'description' => '<em>Menambah</em> data User <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'tambah',
            'created_at' => now(),
        ];
        
        DB::table('logs')->insert($log);
        // /LOG

        // dd('$validatedData');

        return redirect('user')->with('success','Data user berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $users, $uuid)
    {
        $datas = Users::where('uuid', $uuid)->get();

        
        return view('masters.user.edit', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $validatedData = $request->validate([
            'niknis' => 'string|required|max:255',
            'password' => 'string|required|max:255',
            'role' => 'string|required|max:255',
            'nama' => 'string|required|max:255',
            'kelas' => 'string|max:255',
            'jurusan' => 'string|max:255',
            'mapel' => 'string|max:255',
            'kontak' => 'string|required|max:255',

        ]);
        // $validatedData['updated_by'] = Auth::user()->id;
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['updated_by'] = Auth::user()->id;

        Users::where('uuid', $uuid)->first()->update($validatedData);

        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Mengubah</em> data User <strong>[' . $request->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'edit',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        // selesai


        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $users, $uuid)
    {
        $data = Users::get()->where('uuid', $uuid)->firstOrFail();
        // $data->deleted_by = Auth::user()->id;
        $data->save();
        $log = [
            'uuid' => Uuid::uuid4()->getHex(),
            // 'user_id' => Auth::user()->id,
            'description' => '<em>Menghapus</em> data User <strong>[' . $data->name . ']</strong>', //name = nama tag di view (file index)
            'category' => 'hapus',
            'created_at' => now(),
        ];

        DB::table('logs')->insert($log);
        $data->delete();

        return redirect()->route('user.index')->with('delete', 'Data user berhasil dihapus!');
    }
}
