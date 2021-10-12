<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table='product_sizes';

    protected $fillable = [
        'id','name','hash','size_id ','product_id ','created_at','updated_at',
    ];

    protected $hidden = [
        'created_at', 'updated_at','product_id'
    ];

   public function product(){

    return $this->belongsTo(Product::class,'product_id','id');
   }
   
   
   //public function size(){

 //   return $this->belongsTo(Size::class,'size_id','id');
   //}
}
