<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'u01',
            'email' => 'u01@mail.com',
            'password' => bcrypt('123456'),
        ]);

        $arrays = range(0,25);
        $cont=0;
        foreach($arrays as $valor){
            $cont++;            
            $use = 'u'.$cont;
            DB::table('users')->insert([                
                'name' => $use,
                'email' => $use.'@mail.com',
                'password' => bcrypt('123123')
            ]);
        }
    }
}

