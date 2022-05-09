<?php

namespace App\Http\Controllers\FrontApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class CardController extends Controller
{
  use GeneralTrait;

  function __construct()
  {

    // $this->middleware('assign.guard:api', ['except' => ['addeToCard','getMayCard','getVistorId']]);
  }

  public function addeToCard(CardRequest $request)
  {


    try {
      $translation_of = Product::find($request->product_id)->translation_of;
      if ($translation_of == 0) {

        if (Card::where(['product_id' => $request->product_id, 'vistorId' => $request->vistorId])->first() != null)
          return $this->returnError('E001', 'هذاالمنتج  موجود');
        Card::create([
          'product_id' => $request->product_id,
          'quintity' => $request->quintity,
          'vistorId' => $request->vistorId,
        ]);
      } else {

        if (Card::where(['product_id' => $translation_of, 'vistorId' => $request->vistorId])->first() != null)
          return $this->returnError('E001', 'هذاالمنتج  موجود');
        Card::create([
          'product_id' => $translation_of,
          'quintity' => $request->quintity,
          'vistorId' => $request->vistorId,
        ]);
      }

      return $this->returnSuccessMessage('تم اضافة البيانات الى سلة بنجاح', '200');
    } catch (Exception $exp) {

      return $this->returnError(500, 'حدث خطاء ماء');
    }
  }
  // ..................................//

  public function ubdatMyCard(Request $request, $id)
  {
      
    try {
      
      $card = Card::find($id);
      if (!$card)
        return $this->returnError('E001', 'هذاالمنتج غير موجود');
        $quintity= $card->product['quntity'];
        
      $valdator = $request->validateWithBag('put', [
        'quintity' => ['required', 'string'],
      ]);
      
      if($request->quintity>0 and $request->quintity<$quintity){

      Card::where('id', $id)->update([
        'quintity' => $request->quintity,
        'updated_at' => Carbon::now(),
      ]);
      return $this->returnSuccessMessage('تم تعديل البايانات بنجاح', '200');
    }
    else{
      return $this->returnError( '400','الكمية غير متوفرة');
    }
    
    } 
   
    catch (ValidationException $valexp) {
      return $this->returnError(500, "الحقل الكمية مطلوبة");
    } catch (Exception $exp) {
         return $exp;
      return $this->returnError(500, 'حدث خطاء ماء');
    }
  }
   //........................................//
   public function deleteCard($id){

     try{
       $card_id=Card::find($id)->id;

       if(!$card_id)
       return $this->returnError('E001', 'هذاالمنتج  موجود');
       Card::where('id',$card_id)->delete();
       return $this->returnSuccessMessage('تم حذف البايانات بنجاح', '200');
     }
     catch(Exception $exp){
      
      return $this->returnError(500, 'حدث خطاء ماء');
     }
     
  
    
   }
  //........................................//


  public function  getVistorId()
  {

    return $this->returnData('vistorid', uniqid());
  }



  //......................................//

  public function getMayCard($vistorid)
  {

    try {
      $card = Card::where('vistorId', $vistorid)->select('id', 'product_id', 'quintity')->get();

      // $card= Card::with(['product'=>function($qury){
      //   $qury->select("name","id");
      // }])->where('vistorId',$vistorid )->select('id','quintity','product_id')->get();
      //return $card;

      if (!$card)
        return $this->returnError('E001', 'هذاالمنتج  موجود');

      $cards = [];
      foreach ($card as $index => $id) {
        $cards[$index] = [
          'id' => $id['id'],
          'product_id' => Product::select('id')->find($id['product_id'])['id'],
          'name' => Product::select('name')->find($id['product_id'])['name'],
          'image' => Product::find($id['product_id'])->photos()->get()[0]['path'],
          'price' => Product::select('price')->find($id['product_id'])['price'],
          'product_quntity'=>Product::select('quntity')->find($id['product_id'])['quntity'],
          'quintity' => $id['quintity'],
        ];
      }

      return $this->returnData('card', $cards);
    } catch (Exception $expx) {
      return $this->returnError(500, 'حدث خطاء ماء');
    }
  }
  //.................................................//


  public function getCount($vistorid)
  {
    $cards = Card::where('vistorId', $vistorid)->get();

    return $this->returnData('count', count($cards));
  }
}
