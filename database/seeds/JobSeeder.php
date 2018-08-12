<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = ['Editor', 'Managing Editor', 'Author', 'Executive Editor'];
        foreach ($roles as $role)
            DB::table('jobs')->insert(['name' => $role]);
    }
}
