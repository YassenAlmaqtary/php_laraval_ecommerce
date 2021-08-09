<?php

namespace App\Http\Controllers\FrontApi;

use App\Http\Controllers\Controller;
use App\Models\MainCategorie;
use App\Models\SubCategorie;
use App\Traits\GeneralTrait;
use Exception;

class VendorController extends Controller
{
    use GeneralTrait;
    
 public function getAllVendorsWithCatrgoryID($id){

  
    try{
        $subCatgory_id=SubCategorie::find($id)->mainCategory;
        
        $category=MainCategorie::find($subCatgory_id['id']);
        
          if(isset($category)){
         $vendors= $category->vendors()->active()->get();
         
         return $this->returnData('vendors',$vendors);

           
        }
         else 
        return $this->eturnError('404', 'هذا القسم غير موجود');

    }

    catch(Exception $exp){
       
      return $this->returnError(500,'حدث خطاء ماء');

    }
   

 }




}
