<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\EBook;
use App\Models\Order;
use App\Models\User;
use Database\Factories\EBookFactory;
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
        //untuk default admin
        $this->call([
            GenderSeeder::class,
            RoleSeeder::class,
            UserSeeder::class
        ]);
        EBook::factory(20)->create();
        User::factory(5)->create();
        Order::factory(30)->create();
    }
}
