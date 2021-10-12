<?php

namespace App\Http\Controllers\FrontApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;

class CardController extends Controller
{
    use GeneralTrait;

    function __construct()
    {

      $this->middleware('assign.guard:api', ['except' => ['addeToCard','getMayCard']]);
    }

     public function addeToCard(CardRequest $request){
         
         try{
           
           $translation_of=Product::find($request->product_id)->translation_of;
           if($translation_of==0){
           if(Card::where('product_id',$request->product_id)->first()!=null)
            return $this->returnError('E001', 'هذاالمنتج  موجود');
          Card::create([
            'user_id'=>$request->user_id,
            'product_id'=>$request->product_id,
            'quintity'=>$request->quintity,
          ]);
        }
          else{
            if(Card::where('product_id',$translation_of)->first()!=null)
            return $this->returnError('E001', 'هذاالمنتج  موجود');
          Card::create([
            'user_id'=>$request->user_id,
            'product_id'=>$translation_of,
            'quintity'=>$request->quintity,
          ]);
        }

          return $this->returnSuccessMessage('تم اضافة البيانات الى سلة بنجاح','200');
          
         }
         catch (Exception $exp){
           return $exp;
          return $this->returnError(500, 'حدث خطاء ماء');
         }
       }


     public function getMayCard(){



     }

}
