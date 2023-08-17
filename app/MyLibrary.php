<?php 

namespace App;

use App\Models\Logs;
use Illuminate\Support\Facades\Auth;

Class MyLibrary {

    public static function sum($a, $b) {
        return $a + $b;
    }

    public static function ambilNotif($user)
    {
        // dd($user);
        
        if ($user['role'] == "Kepala Jurusan" || $user['role'] == "Laboran") :
            $dataNotif = Logs::with('dataUser')->where('category','peminjaman')->orWhere('category','penggunaan')->orderBy('id', 'DESC')->limit(5)->get();
        else:
            $dataNotif = Logs::with('dataUser')->where('user_id',$user['id'])->where('category','peminjaman')->orWhere('category','penggunaan')->orderBy('id', 'DESC')->limit(5)->get();
        endif;

        return $dataNotif;
    }

}

?>