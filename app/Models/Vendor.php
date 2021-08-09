<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $table='vendors';
  
    protected $fillable = [

    'id','name','mobile', 'address','email','active','logo','main_categorie_id','password','company_name', 'created_at','updated_at'

    ];

    
    protected $hidden = [
        'created_at','updatet_at','password'
    ];
   

    public function scopeActive($qury){

        return $qury->where('active',1);
      }


      public function scopeSelection($qury){

        return $qury->select('id','name','email','address', 'mobile','logo','active','company_name','main_categorie_id');

}

public function getActive()
{
    return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
}


public function setPasswordAttribute($password)
{
    if (!empty($password)) {
        $this->attributes['password'] = bcrypt($password);
    }
}
      
public function category(){
    return $this->belongsTo(MainCategorie::class,'main_categorie_id','id');
  }




}
