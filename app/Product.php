<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public function category(){
    	return $this->belongsTo('App\Category');
    	//Establishes the Many to One relationship of Products to a category.
    	// naming convention :singular
    }
    public function orders(){
    	return $this->belongsToMany('\App\Order', 
    		'order_product')->withPivot('quantity', 
    		'subtotal')->withTimestamps();
    }

    public function supplier(){
    	return $this->belongsToMany('\App\Supplier');

    }

    public function manufacturer(){
    	return $this->belongsToMany('\App\Manufacturer');
    }


    protected $fillable = ['quantity'];

}
