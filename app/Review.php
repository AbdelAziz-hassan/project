<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
     protected $fillable = [
        'review','rate','keystore_id','user_id',
    ];

    public function keystore()
    {
    	return $this->belongsTo('App\Keystore','keystore_id','id');
    }

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
