<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keystore extends Model
{
     protected $fillable = [
        'shop_en_name','shop_ar_name','lat','lang','address','typeOfService','n_w_hours','begin_day','end_day','activeStatues','logo','user_id',
    ];

    public function review()
    {
    	return $this->hasMany('App\Review','keystore_id','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function images()
    {
        return $this->hasMany('App\Image','keystore_id','id');
    }
      protected $hidden = [
        'created_at', 'updated_at',
    ];
}
