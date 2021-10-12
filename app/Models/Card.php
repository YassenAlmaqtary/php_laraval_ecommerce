<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table='cards';


    protected $fillable = [
        'id','user_id', 'color','product_id','created_at','updated_at','quintity'
    ];

    protected $hidden = [
        'created_at', 'updated_at','user_id',
    ];
    

    public function user(){
        
        return $this->belongsTo(User::class,'user_id','id');

      }

        
      public function product(){
        
        return $this->belongsTo(Product::class,'product_id','id');

      }

}
