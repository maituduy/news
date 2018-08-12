<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = ['Thời sự', 'Góc nhìn', 'Thế giới', 'Kinh doanh', 'Giải trí', 'Thể thao'];
        foreach ($categories as $category)
            DB::table('categories')->insert(['name' => $category]);
    }
}
