<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
public $roles=[
    	[
    		'name'=>'super-admin',
    		'label'=>'Super Admin'
   		],
   		[
    		'name'=>'admin',
    		'label'=>'Admin'
   		],
        [
            'name'=>'user',
            'label'=>'User'
        ]
    ]; 

    public function run()
    {
        foreach ($this->roles as $value) {
        	if(! \Spatie\Permission\Models\Role::where('name',$value['name'])->exists()){
        		\Spatie\Permission\Models\Role::create($value);
        	}
        }
    }
}
