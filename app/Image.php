<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image_name','keystore_id',
        ];

    public function keystore(){
    	return $this->belongsTo('App\Keystore','keystore_id','id');
    }
      protected $hidden = [
        'created_at', 'updated_at',
    ];
}
