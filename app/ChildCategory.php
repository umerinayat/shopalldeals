<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable = ['name','slug', 'sub_category_id'];
    public $timestamps = false;

    public function sub_category()
    {
    	return $this->belongsTo('App\SubCategory');
    }

    public function deals ()
    {
    	return $this->hasMany('App\Deal');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }


    public static function storeChildCategory ($inputs)
    {
        $childCategory = ChildCategory::create([
            'name' => $inputs['name'],
            'slug' => $inputs['slug'],
            'sub_category_id' => $inputs['sub_category_id'],
        ]);
        return $childCategory;
    }

    public static function updateChildCategory ($inputs, $childCategory)
    {
        $childCategory->update([
            'name' => $inputs['name'],
            'slug' => $inputs['slug'],
            'sub_category_id' => $inputs['sub_category_id'],
        ]);
        return $childCategory;
    }

}
