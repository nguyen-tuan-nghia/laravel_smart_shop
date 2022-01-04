<?php

use Illuminate\Database\Seeder;
use App\roles;
class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        roles::truncate();
        roles::create(['name'=>'admin']);
        roles::create(['name'=>'auther']);
        roles::create(['name'=>'reply']);

    }
}
