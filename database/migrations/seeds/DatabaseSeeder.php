<?php

use Illuminate\Database\Seeder;
use App\roles;
use App\admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		roles::truncate();
        roles::create(['name'=>'admin']);
        roles::create(['name'=>'author']);
        roles::create(['name'=>'reply']);
		// $this->call(roleSeeder::class);

        // $this->call(UserSeeder::class);
        admin::truncate();
        $adminrole=roles::where('name','admin')->first();
		$authorrole=roles::where('name','author')->first();
        $replyrole=roles::where('name','reply')->first();
        $admin=admin::create([
        	'admin_email'=>'nghia1406@gmail.com',
        	'admin_password'=>md5('111'),
        	'admin_name'=>'nghia',
        	'admin_phone'=>'09999'
        ]);
		$author=admin::create([
        	'admin_email'=>'thang@gmail.com',
        	'admin_password'=>md5('111'),
        	'admin_name'=>'thang',
        	'admin_phone'=>'09999'
        ]);
		$reply=admin::create([
        	'admin_email'=>'ha@gmail.com',
        	'admin_password'=>md5('111'),
        	'admin_name'=>'ha',
        	'admin_phone'=>'09999'
        ]);
        $admin->roles()->attach($adminrole);
        $author->roles()->attach($authorrole);
        $reply->roles()->attach($replyrole);
    }
}
