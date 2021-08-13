<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategorie extends Model
{

    protected $table = 'main_categories';

    protected  $fillable = [
        'id', 'translation_lang', 'translation_of', 'name', 'slug', 'photo', 'active', 'created_at', 'updated_at'
    ];


    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public $timestamps = false;
    


    public function scopeActive($qury)
    {

        return $qury->where('active', 1);
    }

    public function scopeSelection($qury)
    {

        return $qury->select('id', 'translation_lang', 'name', 'photo', 'slug', 'active');
    }



    public function getActive()
    {

        return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
    }


    public function categorys()
    {
      return $this->hasMany(self::class,'translation_of');
    }


    public function vendors(){
      return $this->hasMany(Vendor::class,'main_categorie_id','id');
    }

    public function Subctegorys(){
        return $this->hasMany(SubCategorie::class,'main_categorie_id','id');
      }

      public function proudcts(){
        return $this->hasMany(Product::class,'main_categorie_id','id');
      }

}
