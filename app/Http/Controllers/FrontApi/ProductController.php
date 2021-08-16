<?php

namespace App\Http\Controllers\FrontApi;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategorie;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Exception;

class ProductController extends Controller
{
    use GeneralTrait;

    public function getProuductWithSubCategory($subcategry_id,$vendor_id){
        
        try{

            $subcatgory= SubCategorie::find($subcategry_id);
         
        if(!$subcatgory)
        return $this->returnError('404', 'هذا القسم غير موجود');
        if($subcatgory->translation_of==0)
          $products= $subcatgory->products;
        else{
         $translation_of=$subcatgory->translation_of;
         $subcatgory=SubCategorie::find($translation_of);
         if(!$subcatgory)
         return $this->returnError('404', 'هذا القسم غير موجود');
        
        }
      
         $products_id=$subcatgory->products()->where(['translation_lang' => get_defoult_langug(), 'active' => 1,'vendor_id'=>$vendor_id])->select('id')->get();
         if(isset($products_id)&& $products_id->count()>0){
          $products=[];
        foreach($products_id as $product){
         $products=[Product::with(['Subctegory'=>function($qury){
             $qury->select('name','id');
         },
         'photos'=>function($qury){
           $qury->select('path','product_id');
         }])->find($product->id)];
        }
      
        
        return $this->returnData('products',$products);
      }
      else
      return $this->returnError(404,"لايوجد تجار في هذا القسم");
    

        }
        catch(Exception $exp){}
        
        return $this->returnError(500,'حدث خطاء ماء');
      
      
       }



}
