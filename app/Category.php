<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug', 'order'];
    public $timestamps = false;

    public function subs ()
    {
    	return $this->hasMany('App\SubCategory');
    }

    public function deals ()
    {
    	return $this->hasMany('App\Deal');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public static function storeCategory ($inputs)
    {
        $category = Category::create([
            'name' => $inputs['name'],
            'slug' => $inputs['slug'],
            'order' => $inputs['order'],
        ]);
        return $category;
      
    }

    public static function updateCategory ($inputs, $category)
    {
        $category->update([
            'name' => $inputs['name'],
            'slug' => $inputs['slug'],
            'order' => $inputs['order'],
        ]);
        $category;
    }
}
