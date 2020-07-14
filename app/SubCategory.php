<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'category_id'
    ];
    public $timestamps = false;
    
    public function category ()
    {
        return $this->belongsTo('App\Category');
    }

    public function childs()
    {
    	return $this->hasMany('App\ChildCategory');
    }

    public function deals ()
    {
    	return $this->hasMany('App\Deal');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }


    public static function storeSubCategory ($inputs)
    {
        $subCategory = SubCategory::create([
            'name' => $inputs['name'],
            'slug' => $inputs['slug'],
            'category_id' => $inputs['category_id'],
        ]);
        return $subCategory;
    }

    public static function updateSubCategory ($inputs, $subCategory)
    {
        $subCategory->update([
            'name' => $inputs['name'],
            'slug' => $inputs['slug'],
            'category_id' => $inputs['category_id'],
        ]);
        return $subCategory;
    }
}
