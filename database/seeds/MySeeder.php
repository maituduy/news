<?php

use Illuminate\Database\Seeder;

class MySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new \App\Admin;
        $admin->email = 'd@g.com';
        $admin->name = 'Mai Tu Duy';
        $admin->password = bcrypt('123456'); 
        $job        = collect(\App\Job::all())->random();
        $category   = collect(\App\Category::all())->random();
        $admin->job()->associate($job);
        $admin->category()->associate($category);
        $admin->save();
    }
}
