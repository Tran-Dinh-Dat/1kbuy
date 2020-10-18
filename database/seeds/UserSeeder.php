<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Collection;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i=1; $i <= 10 ; $i++) { 
            DB::table('users')->insert([
                'email' => 'user'.$i.'@gmail.com',
                'password' => bcrypt(123123123),
                'name' => 'user'.$i,
                'role' => 0
                ]
            );
        }
    }
}
