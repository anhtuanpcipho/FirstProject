<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LoginUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'email' => 'lxc150896@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'email' => 'lxc@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
            ],
        ];
        DB::table('login_users')->insert($data);
    }
}
