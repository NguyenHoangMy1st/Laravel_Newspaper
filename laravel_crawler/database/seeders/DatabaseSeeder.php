<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
        \DB::table('admins')->insert([
            'email'      => 'admin@gmail.com',
            'password'   => bcrypt('123456'),
            'name'       => 'Admin',
            'phone'      => '0986420994',
            'created_at' => Carbon::now()
        ]);
    }
}
