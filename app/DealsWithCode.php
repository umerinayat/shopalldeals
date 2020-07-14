<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealsWithCode extends Model
{
    protected $fillable = [
        'deal_id', 'copy_code',
    ];

    public function deal () 
    {
        return $this->belongsTo('App\Deal');
    }

    public static function storeDealsWithCode ($data, $deal)
    {
        $deal->update([
            'deal_type' => 'code'
        ]);

        $newDealWithCode = DealsWithCode::create([
            'deal_id' => $deal->id,
            'copy_code' => $data['copy_code']
        ]);

        return $newDealWithCode;
    }

    public static function updateDealsWithCode ($data, $deal)
    {
        $updatedDealWithCode = DealsWithCode::where('deal_id', $deal->id)->get()[0]->update([
            'deal_id' => $deal->id,
            'copy_code' => $data['copy_code']
        ]);

        return $updatedDealWithCode;
    }
}
