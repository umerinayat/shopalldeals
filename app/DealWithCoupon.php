<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealWithCoupon extends Model
{
    protected $fillable = [
        'deal_id', 'savings', 'coupon_code',
    ];

    public function deal () 
    {
        return $this->belongsTo('App\Deal');
    }

    public static function storeDealWithCoupon ($data, $deal)
    {
        $deal->update([
            'deal_type' => 'coupon'
        ]);

        $newDealWithCoupon = DealWithCoupon::create([
            'deal_id' => $deal->id,
            'savings' => $data['savings'],
            'coupon_code' => $data['coupon']
        ]);

        return $newDealWithCoupon;
    }

    public static function updateDealWithCoupon ($data, $deal)
    {
        $updatedDealWithCoupon = DealWithCoupon::where('deal_id', $deal->id)->get()[0]->update([
            'deal_id' => $deal->id,
            'savings' => $data['savings'],
            'coupon_code' => $data['coupon']
        ]);

        return $updatedDealWithCoupon;
    }
}
