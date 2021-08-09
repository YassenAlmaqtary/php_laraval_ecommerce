<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Languge extends Model
{
    
    protected $table='languges';
  
    protected $fillable = [

    'id','locale','abbr', 'name','direction','active','created_at','updated_at'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updatet_at'
    ];


    public function scopeActive($qury){

        return $qury->where('active',1);
      }


      public function scopeSelection($qury){

        return $qury->select('id','abbr', 'name','direction','active');

}

    public function getActive(){

       return $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
      }

}