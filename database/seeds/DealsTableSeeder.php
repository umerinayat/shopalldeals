<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 500; $i++)
        {
            $id = DB::table('deals')->insertGetId([
                'link_to_deal' => 'https://www.alibaba.com/product-detail/Original2018-xiao-mi-Mi-4-65_62031564686.html?spm=a27aq.13957185.5_0.1.7d981ed4C8OOX5&bypass=true',
                'title' => 'Original2018 xiao mi Mi 4 65 inches Smart tv_' . $i,
                'meta_title' => 'Original2018 xiao mi Mi 4 65 inches Smart tv',
                'meta_description' => "Start with a short paragraph of at least 160 characters, this short description will use to generate SEO dynamic meta description for the current deal. Lor...",
                'slug' => 'original2018-xiao-mi-mi-4-65-inches-smart-tv-'. $i,
                'old_price' => '40.00',
                'new_price' => '30.00',
                'discount' => '10% OFF',
                'image' => 'UTB8MWNzq3nJXKJkSaelq6xUzXXak.jpg_350x350.jpg',
                'short_description' => "Start with a short paragraph of at least 160 characters, this short description will use to generate SEO dynamic meta description for the current deal. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'description' => '<b>test description</b>',
                'is_free_shipping' => 1,
                'is_expired' => 0,
                'deal_type' => 'deal',
                'category_id' => '1',
                'store_id' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

    }
}
