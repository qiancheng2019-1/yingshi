<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
            'username'=>'admin',
            'realname'=>'admin',
            'password'=>bcrypt('admin888'),
            'status'=>'0',
            'created_at'=>date('Y-m-d H:s:i'),
            'updated_at'=>date('Y-m-d H:s:i'),
        ];
        DB::table('admins')->insert($data);
        $data=[
            'username'=>'test',
            'realname'=>'test',
            'password'=>bcrypt('test888'),
            'status'=>'1',
            'created_at'=>date('Y-m-d H:s:i'),
            'updated_at'=>date('Y-m-d H:s:i'),
        ];
        DB::table('admins')->insert($data);
    }
}
