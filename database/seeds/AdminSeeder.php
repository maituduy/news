<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Admin::class, 50)->create()->each(function ($a) {
            $job        = collect(\App\Job::all())->random();
            $category   = collect(\App\Category::all())->random();
            $a->job()->associate($job);
            $a->category()->associate($category);
            $a->save();
        }) ;
    }
}
