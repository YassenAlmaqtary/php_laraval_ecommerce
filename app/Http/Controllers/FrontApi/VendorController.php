<?php

namespace App\Http\Controllers\FrontApi;

use App\Http\Controllers\Controller;
use App\Models\MainCategorie;
use App\Models\Product;
use App\Models\SubCategorie;
use App\Models\Vendor;
use App\Traits\GeneralTrait;
use Exception;

class VendorController extends Controller
{
    use GeneralTrait;
    
 public function getAllVendorsWithsubCatrgoryID($id){

  
    try{
        $mainCategory=SubCategorie::find($id)->mainCategory;
      
          if(isset($mainCategory)){
             
         $vendors= $mainCategory->vendors()->active()->get();
         
         return $this->returnData('vendors',$vendors);

           
        }
         else 
        return $this->returnError('404', 'هذا القسم غير موجود');

    }

    catch(Exception $exp){
       
      return $this->returnError(500,'حدث خطاء ماء');

    }
   

 }
  

 public function getVendorOfProduct($subcategry_id)
 {  
    try{

       $subcatgory= SubCategorie::find($subcategry_id);
   
      if(!$subcatgory)
      return $this->returnError('404', 'هذا القسم غير موجود');
      if($subcatgory->translation_of!=0){
       $translation_of=$subcatgory->translation_of;
       $subcatgory=SubCategorie::find($translation_of);
       if(!$subcatgory)
       return $this->returnError('404', 'هذا القسم غير موجود');
       
      }
  
       $products=$subcatgory->products()->where(['translation_lang' => get_defoult_langug(), 'active' => 1])->get();
       
        
       if(isset($products)&& $products->count()>0){
         $vendors=[];
      
      foreach($products as $index=>$product){
         $vendor=Vendor::find($product->vendor_id);
        if(nullSercheValueincollect($vendors,$vendor))
         $vendors[$index]=$vendor;

      }
      
      
       return $this->returnData('vendors',$vendors);
     }
     else
     return $this->returnError(404,"لايوجد تجار في هذا القسم");
     

    }
    catch(Exception $exp){
      
      return $this->returnError(500,'حدث خطاء ماء');
    }
    
 }



  public function getProductofVendor($vendor_id){
    try{
      
      $vendor=Vendor::find($vendor_id);
      if(!$vendor)
      return $this->returnError('404', 'هذا القسم غير موجود');
       $products=$vendor->products;
       return $products;
    }
    catch(Exception $exp){

    }
    
 

}

}