<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table='colors';

    protected $fillable = [
        'id', 'name','hex'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
    
    //public function colors(){

      //  return $this->hasMany(ProductColor::class,'color_id','id');
      //}
    
   

}
