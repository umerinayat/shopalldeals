<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name', 'slug', 'order'
    ];

    public $timestamps = false;

    public function deals () 
    {
        return $this->hasMany('App\Deal');
    }
    
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public static function storeStore ($inputs)
    {
        $store = Store::create([
            'name' => $inputs['name'],
            'slug' => $inputs['slug'],
            'order' => $inputs['order'],
        ]);
        return $store;
    }

    public static function updateStore ($inputs, $store)
    {
        $store = $store->update([
            'name' => $inputs['name'],
            'slug' => $inputs['slug'],
            'order' => $inputs['order'],
        ]);
        return $store;
    }
}
