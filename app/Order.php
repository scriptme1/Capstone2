<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
    	return $this->belongsTo('\App\User');
    }
    
    public function products(){
    	return $this->belongsToMany('\App\Product', 
    		'order_product')->withPivot('quantity', 
    		'subtotal')->withTimestamps();
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }
}
