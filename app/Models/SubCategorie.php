<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategorie extends Model
{

    protected $table = 'sub_categories';

    protected  $fillable = [
        'id', 'translation_lang','main_categorie_id', 'translation_of', 'name', 'slug', 'photo', 'active', 'created_at', 'updated_at'
    ];

    protected $hidden = [
    'created_at', 'updated_at','main_categorie_id'
    ];


    public function scopeActive($qury)
    {

        return $qury->where('active', 1);
    }

    public function scopeSelection($qury)
    {

        return $qury->select('id', 'translation_lang', 'name', 'photo', 'slug', 'active','main_categorie_id');
    }
    

    public function getActive()
    {

        return $this->active == 1 ? 'مفعل'  : 'غير مفعل';
    }


    public function categorys()
    {
      return $this->hasMany(self::class,'translation_of');
    }

 
    public function mainCategory()
    {
      return $this->belongsTo(MainCategorie::class,'main_categorie_id','id');
    }


    public function products(){
        return $this->hasMany(Product::class,'sub_categorie_id','id');
      }


}
