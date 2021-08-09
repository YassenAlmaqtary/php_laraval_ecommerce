<?php

namespace App\Http\Controllers\FrontApi;

use App\Http\Controllers\Controller;
use App\Models\MainCategorie;
use App\Models\SubCategorie;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{ 
    use GeneralTrait;
     
    public function getAllCategory(){
    
     $categorys=MainCategorie::where('translation_lang',get_defoult_langug())->select('id','name','photo','translation_of')->get();
      try{
        if(!$categorys)
        return $this-> returnError('E001','هذا الثسم الرئيسي غير موجود');
           
        return $this->returnData('categorys',$categorys);
      }
     catch (Exception $exp){
        return $this->returnError($exp->getCode(), $exp->getMessage());
     }
     
          


    }


    public function getsubCategoryWithId($id){
    
      
        try{
            $mainCategorys=MainCategorie::find($id);

            
            if(!$mainCategorys)
               return $this-> returnError('E001','هذا الثسم الرئيسي غير موجود');
        
               $subCategorys= $mainCategorys->Subctegorys()->where(['translation_lang'=>get_defoult_langug(),'active'=>1])->select('id','name','photo','translation_of')->get();
               if(!$subCategorys)
                 return $this-> returnError('E001','هذا القسم الفرعي غيؤ موجود');

               return $this->returnData('subcategorys',$subCategorys);
        }
        catch(Exception $exp){
           return $this->returnError($exp->getCode(), $exp->getMessage());

        }
             
   
   
       }    


}
