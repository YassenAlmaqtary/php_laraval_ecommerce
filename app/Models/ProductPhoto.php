<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = 'proudct_photos';


    protected  $fillable = [
        'id','product_id','path','created_at', 'updated_at',
    ];


    protected $hidden = [
        'product_id','created_at', 'updated_at'
    ];

    
    public function product(){
        
        return $this->belongsTo(Product::class,'product_id','id');
        
      }


}
