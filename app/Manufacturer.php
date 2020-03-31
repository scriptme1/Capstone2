<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Manufacturer extends Model
{
 
    protected $fillable = ['name', 'address','contact_person','contact_number', 'email'];



    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function suppliers()
    {
    	return $this->belongsToMany('App\Supplier');
    }

    // public function orders()
    // {
    // 	return $this->belongsToMany('App\Order');
    // }

}

