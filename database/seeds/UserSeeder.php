<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

	    factory(App\User::class)->create(['name' => 'Vinayak','email' => 'demo@example.com', 'password'=> Hash::make('123456')]);
    }
}
