<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopalldealsDbTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // categories
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->smallInteger('order')->default(1);
        });

        // sub_categories
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
        });

        // child categories
        Schema::create('child_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->unsignedBigInteger('sub_category_id')->index();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });

        // stores
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->smallInteger('order')->default(1);
        });

        // deals
        Schema::create('deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link_to_deal');
            $table->string('title');
            $table->string('old_price')->nullable();
            $table->string('new_price')->nullable();
            $table->string('discount')->nullable();
            $table->string('image')->nullable();
            $table->mediumText('short_description');
            $table->longText('description');
            $table->tinyInteger('is_free_shipping')->default(false);
            $table->string('deal_type')->default('deal');
            //deal_types [deal, code, coupon]
            $table->tinyInteger('is_expired')->default(false);
            // SEO
            $table->string('slug')->unique()->index();
            $table->string('meta_title');
            $table->string('meta_description');

            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id')->nullable()->index();
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->unsignedBigInteger('childcategory_id')->nullable()->index();
            $table->foreign('childcategory_id')->references('id')->on('child_categories')->onDelete('cascade');

            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');

            $table->timestamps();
        });
        
        // deal_with_codes
        Schema::create('deals_with_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('copy_code');
            
            $table->unsignedBigInteger('deal_id')->index();
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');

            $table->timestamps();
        });


        // coupons
        Schema::create('deal_with_coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('savings');
            $table->string('coupon_code');

            $table->unsignedBigInteger('deal_id')->index();
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');

            $table->timestamps();
        });

        // website_settings
        Schema::create('website_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('footer_text')->nullable();
            $table->longText('copyright_text')->nullable();
            $table->longText('termsnc_text')->nullable();
            $table->longText('privacy_policy_text')->nullable();
            $table->longText('about_us')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sub_categories');
        Schema::dropIfExists('child_categories');
        Schema::dropIfExists('stores');
        Schema::dropIfExists('deals');
        Schema::dropIfExists('deals_with_codes');
        Schema::dropIfExists('deal_with_coupons');
        Schema::dropIfExists('website_settings');        
    }
}
