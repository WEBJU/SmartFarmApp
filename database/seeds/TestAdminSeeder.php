<?php

use Illuminate\Database\Seeder;

class TestAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array('name'=>'admin','email'=>'admin@gmail.com','password'=>\Hash::make('123456'),'profile_pic'=>'default.png');
        \App\Models\User::create($data)->assignRole(\Spatie\Permission\Models\Role::where('name','super-admin')->first());
    }
}
