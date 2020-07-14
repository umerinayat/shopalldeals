<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clothing = DB::table('categories')->insertGetId([
            'name' => 'Clothing',
            'order' => 1
        ]);

            $menAccessories = DB::table('sub_categories')->insertGetId([
                'name' => 'Accessories',
                'type' => 'Men',
                'category_id' =>  $clothing,
            ]);

            $womenAccessories = DB::table('sub_categories')->insertGetId([
                'name' => 'Accessories',
                'type' => 'Women',
                'category_id' =>  $clothing,
            ]);

            
            $menShoes = DB::table('sub_categories')->insertGetId([
                'name' => 'Shoes',
                'type' => 'Men',
                'category_id' =>  $clothing,
            ]);

            $womenShoes = DB::table('sub_categories')->insertGetId([
                'name' => 'Shoes',
                'type' => 'Women',
                'category_id' =>  $clothing,
            ]);

        $computers = DB::table('categories')->insertGetId([
            'name' => 'Computers',
            'order' => 2
        ]);
            
        $laptopsLaptopBags = DB::table('sub_categories')->insertGetId([
            'name' => 'Laptop Bags',
            'type' => 'Laptops',
            'category_id' =>  $computers,
        ]);

        $ipadsAndTablets = DB::table('sub_categories')->insertGetId([
            'name' => 'Ipads',
            'type' => 'Ipad & Tablets',
            'category_id' =>  $computers,
        ]);

    }
}
