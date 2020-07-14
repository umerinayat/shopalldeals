<?php

namespace App;

use App\DealsWithCode;

use App\DealWithCoupon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;


class Deal extends Model
{
    protected $fillable = [
        'link_to_deal', 'title', 'old_price', 'new_price',
        'discount', 'image', 'description','short_description', 'is_free_shipping',
        'category_id', 'subcategory_id', 'childcategory_id', 'store_id', 'is_expired', 'deal_type', 'slug', 'meta_title', 'meta_description'
    ];

    public function code ()
    {
        return $this->hasOne('App\DealsWithCode');
    }

    public function coupon ()
    {
        return $this->hasOne('App\DealWithCoupon');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory');
    }

    public function childcategory()
    {
        return $this->belongsTo('App\ChildCategory');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public static function storeDeal($data, $dealWithCode=null) 
    {   
        $newDeal = Deal::create([
            'link_to_deal' => $data['link_to_deal'],
            'title' => $data['title'],
            'old_price' => $data['old_price'],
            'new_price' => $data['new_price'],
            'discount' => $data['discount'],
            'image' => basename($_FILES["image"]["name"]),
            'description' => $data['description'],
            'short_description' => $data['short_description'],
            'is_free_shipping' => $data['is_free_shipping'],
            'deal_type' => $data['deal_type'],
            'is_expired' => $data['is_expired'],
            'category_id' => $data['category_id'],
            'subcategory_id' => $data->input('subcategory_id', NULL),
            'childcategory_id' => $data->input('childcategory_id', NULL),
            'store_id' => $data['store_id'],
            'slug' => $data['slug'],
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
        ]);
        
        // saving deal image
        $target_dir = public_path() . "/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // dd("The file ". basename( $_FILES["image"]["name"]). " has been uploaded.");
            } else {}

        if ( $data['deal_type'] == 'code' ) 
        {
            $newDealWithCode = DealsWithCode::storeDealsWithCode($data, $newDeal);
        } 
        else if ($data['deal_type'] == 'coupon')
        {
            $newDealWithCoupon = DealWithCoupon::storeDealWithCoupon($data, $newDeal);
        }

        return $newDeal;
        
    }


    public static function updateDeal($deal, $data, $dealWithCode=null)
    {

       $deal->update([
            'link_to_deal' => $data['link_to_deal'],
            'title' => $data['title'],
            'old_price' => $data['old_price'],
            'new_price' => $data['new_price'],
            'discount' => $data['discount'],
            'description' => $data['description'],
            'short_description' => $data['short_description'],
            'is_free_shipping' => $data['is_free_shipping'],
            'deal_type' => $data['deal_type'],
            'is_expired' => $data['is_expired'],
            'category_id' => $data['category_id'],
            'subcategory_id' => $data->input('subcategory_id', NULL),
            'childcategory_id' => $data->input('childcategory_id', NULL),
            'store_id' => $data['store_id'],
            'slug' => $data['slug'],
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
        ]);

      
        

        if ( isset($data['image'])  ) 
        {   
            
            $deal->update([
                'image' => basename($_FILES["image"]["name"]),
            ]);

            // saving deal image
            $target_dir = public_path() . "/images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // dd("The file ". basename( $_FILES["image"]["name"]). " has been uploaded.");
                } else {}
        }
      
        if ( $data['deal_type'] == 'code' ) 
        {
            DealsWithCode::updateDealsWithCode($data, $deal);
        } 
        else if ($data['deal_type'] == 'coupon')
        {
            DealWithCoupon::updateDealWithCoupon($data, $deal);
        }
        return $deal;
    }
}
