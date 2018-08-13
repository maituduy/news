<?php

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
        $this->call([
            JobSeeder::class,
            CategorySeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            MySeeder::class
        ]);
    }
}
