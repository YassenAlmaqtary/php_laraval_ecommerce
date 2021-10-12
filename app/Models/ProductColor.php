<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $table='product_colors';

    protected $fillable = [
        'id','color_id','product_id','hex','hash','created_at','updated_at',
    ];

    protected $hidden = [
        'created_at', 'updated_at','product_id'
    ];

   public function product(){

    return $this->belongsTo(Product::class,'product_id','id');

   }
   
   
  // public function color(){

    //return $this->belongsTo(Color::class,'color_id','id');

   //}



}
