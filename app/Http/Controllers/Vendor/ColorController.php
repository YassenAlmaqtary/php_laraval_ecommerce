<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontApi\ProductController;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       try{
        $product = Product::find($id);
        if (!$product)
            return redirect()->route('vendor.product.index')->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
        $name_product = $product->name;
        $colors=$product->productColors;
        $color_arry=[];
        if($colors->count()>0){
        foreach($colors as $index=>$color){
        $color_arry[$index]=["color"=>Color::where('hex',$color->hex)->first()->name,"id"=>$color->id];
        }
        
        return view('vendor.colors_product.show', compact('name_product','color_arry'));
        }
        else
        return redirect()->route('vendor.product.index')->with(['error' => 'لايحتوي على الوان او ربما تم حذفة']);
        
       }
       catch(Exception $exp){
         return($exp);  
        return  redirect()->route('vendor.product.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
           
            $color = ProductColor::find($id);
            
            if (!$color)
                return redirect()->route('vendor.product.index')->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
              $name_product=$color->product->name;
              $color_name=Color::where('hex',$color->hex)->first()->name;
              $colors=Color::select('hex','name')->get();

            return view('vendor.colors_product.ubdate', compact('color','color_name', 'name_product','colors'));
        } catch (Exception $exp) {
            return  redirect()->route('vendor.product.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $color=ProductColor::find($id);
            if (!$color)
             return redirect()->route('vendor.product.index')->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
             $name=ProductColor::where(['hash'=>$color->hash,'hex'=>$request->color])->select('hex')->first();
             if($name!=null)
                 return redirect()->route('vendor.product.index')->with(['error' => 'يجب ان لا يتكرر']);   
            DB::beginTransaction();
                ProductColor::where(['hex'=>$color->hex,'hash'=>$color->hash])->update([
                'hex'=>$request->color,
                'updated_at' => Carbon::now(),

                ]);
        
            DB::commit();
            return redirect()->route('vendor.product.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $exp) {
            return $exp;
            DB::rollback();
            return  redirect()->route('vendor.product.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try{
           
            $color = ProductColor::find($id);
            if (!$color)
                return redirect()->route('vendor.color.show', $id)->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
            ProductColor::where(['hex'=>$color->hex,'hash'=>$color->hash])->delete();
            return redirect()->route('vendor.product.index')->with(['success' => 'تم حذف البيانات بنجاح']);

         }
         catch(Exception $exp){
            
            return  redirect()->route('vendor.product.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
         }
    }
}
