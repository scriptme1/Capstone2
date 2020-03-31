<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Supplier extends Model
{

	protected $fillable = ['name', 'address','contact_person','contact_number', 'email'];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    
}
