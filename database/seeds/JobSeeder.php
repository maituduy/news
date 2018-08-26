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
        $roles = ['Biên Tập Viên', 'Tổng Biên Tập', 'Phóng viên', 'Phó Tổng Biên Tập'];
        foreach ($roles as $role)
            DB::table('jobs')->insert(['name' => $role]);
    }
}
