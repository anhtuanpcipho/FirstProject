<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Work;

use Illuminate\Support\Str;

use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        for ($i=0; $i < 10; $i++) { 
	    	DB::table('works')->insert([
                'image' => '',
                'collaborator' => 'default',
                'title' => 'Text:'.Str::random(3),
                'deadline' => '22-2-2022',
                'workdone' => '50',
                'note' => 'Default Note!',
            ]);
    	}
    }
}
