<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseSeeder extends Seeder
{
    public function run()
    {

        for($i=0; $i<=10; $i++) {
            $admins[] = [
                'name' => 'Sanjar'.$i,
                'password' => bcrypt(123456),
                'email' => 'cambredgi@gmail.com' .$i
            ];
        }

        DB::table('users')->insert($admins);
    }
}
