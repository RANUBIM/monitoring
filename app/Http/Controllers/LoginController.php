<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Auth;
use App\Models\User;

use Ramsey\Uuid\Uuid;

//pastikan aktifkan ini utk cek auth loginya
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      // dd("ini adalah halaman login");
      return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

  private function passwordCorrect($suppliedPassword)
  {
      return Hash::check($suppliedPassword, User::get()->password, []);
      // dd('tested');
  }

  public function authenticate(Request $request)
  {
      $credentials = $request->validate([
        'niknis'=> 'required',
        'password' => 'required',
    ]);

    // LOGIN BIASA
    // if($user && $request->password == $user->password){
    //   // dd("sukses");
    //   Auth::login($user);
    //   if(Auth::check()){

    //   $request->session()->regenerate();

    //   $data = User::get()->where('niknis', $request->niknis)->firstOrFail();

    //   $log = [
    //       'uuid' => Uuid::uuid4()->getHex(),
    //       'user_id' => Auth::user()->id,
    //       'description' => '<em>Login</em> akun <strong>[' . $data->nama . ']</strong>',
    //       'category' => 'login',
    //       'created_at' => now(),
    //   ];

    //   DB::table('logs')->insert($log);

    //   return redirect()->intended('/');

    //   }
    // }else{
    //   return back()->with('loginError', 'Username atau Password salah');
    // }
    // /LOGIN BIASA

    // COBA RESEARCH LOGIN  
    //   Auth::login($user);
    //   if(Auth::check()){
    //     return "success";
    //   }else{
    //       return "not logged in";
    //   }
    // // return "Success";
    // }else{
    //   return "Error";
    // }
    // COBA RESEARCH LOGIN  
          
    
    if (Auth::attempt($credentials)) {

      $request->session()->regenerate();

      $data = User::get()->where('niknis', $request->niknis)->firstOrFail();

      $log = [
          'uuid' => Uuid::uuid4()->getHex(),
          'user_id' => Auth::user()->id,
          'description' => '<em>Login</em> akun <strong>[' . $data->nama . ']</strong>',
          'category' => 'login',
          'created_at' => now(),
      ];

      DB::table('logs')->insert($log);

      return redirect()->intended('/');
    }


    return back()->with('loginError', 'Username atau Password salah');
  }


  public function logout(Request $request)
  {
      $data = User::get()->where('uuid', Auth::user()->uuid)->firstOrFail();
      $log = [
        'uuid' => Uuid::uuid4()->getHex(),
        'user_id' => Auth::user()->id,
        'description' => '<em>Log out</em> akun <strong>[' . $data->nama . ']</strong>',
        // 'description' => '<em>Log out</em> akun',
        'category' => 'logout',
        'created_at' => now(),
      ];

      DB::table('logs')->insert($log);

      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
  {
        //testes
  }

  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //
    }
  }