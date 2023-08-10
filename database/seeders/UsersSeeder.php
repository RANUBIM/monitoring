<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User;
        $user->uuid = Uuid::uuid4()->getHex();
        $user->niknis = "support";
        $user->role = "Kepala Jurusan";
        $user->nama = "support";
        $user->kelas = "support";
        $user->jurusan = "support";
        $user->mapel = "support";
        $user->kontak = "support";
        $user->citizens_id = 0;
        $user->password = Hash::make("123456");
        $user->created_by = 1;
        $user->save();
      
        $this->command->info("All User success inserted");
    }
}
