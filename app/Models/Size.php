<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table='sizes';

    Protected $fillable = [
        'id', 'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'

    ];

  //  public function sizes(){

       // return $this->hasMany(ProductSize::class,'size_id','id');
     // }


}
