<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'footer_text',
        'copyright_text',
        'termsnc_text',
        'privacy_policy_text',
        'about_us',
    ];

    public static function storeWebsiteSetting ( $inputs ) 
    {
        return WebsiteSetting::create( $inputs );
    }

    public static function updateWebsiteSetting ( $inputs, $websiteSetting )
    {
        return $websiteSetting->update( $inputs );
    }

}
