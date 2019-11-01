<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $filable = ['id', 'name_product','id_type','description','unit_price','promotion_price','image','unit','new'];
    public $timestamps = true;

    public function product_type()
    {
        return $this->belongsTo('App\ProductType', 'id_type', 'id');
    }

    public function bill_detail()
    {
        return $this->hasMany('App\BillDetail', 'id_product', 'id');
    }
}
