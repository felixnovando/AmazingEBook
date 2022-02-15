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
            'role_id' => 2,
            'gender_id' => 1,
            'first_name' => "Admin",
            'middle_name' => "",
            'last_name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => bcrypt('admin'),
            'display_picture_link' => '-',
            'delete_flag' => 0,
            'modified_at' => now(),
            'modified_by' => 'Admin',
        ]);
    }
}
