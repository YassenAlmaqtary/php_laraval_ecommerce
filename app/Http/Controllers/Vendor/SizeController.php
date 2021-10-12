<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
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
        //
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
            $sizes=$product->productSizes;
            $size_arry=[];
            
            if($sizes->count()>0){
            foreach($sizes as$index=>$size){
            $size_arry[$index]=["size"=>$size->name,"id"=>$size->id];
            }
            
            return view('vendor.sizes_product.show', compact('name_product','size_arry'));
            }
            else
            return redirect()->route('vendor.product.index')->with(['error' => 'لايحتوي على احجام او ربما تم حذفة']);
            
           }
           catch(Exception $exp){
            
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
        try{
            $size = ProductSize::find($id);     
        if (!$size)
            return redirect()->route('vendor.product.index')->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
            $name_product=$size->product->name;
        
           $sizes=Size::select('name')->get();
         
        return view('vendor.sizes_product.ubdate', compact('size', 'name_product','sizes'));
        }

      catch (Exception $exp) {
        return $exp;
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

            $size=ProductSize::find($id);
              
            if (!$size)
            return redirect()->route('vendor.product.index')->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
            $name=ProductSize::where(['hash'=>$size->hash,'name'=>$request->size])->select('name')->first();
            if($name!=null)
                return redirect()->route('vendor.product.index')->with(['error' => 'يجب ان لا يتكرر']);
            DB::beginTransaction();
                ProductSize::where(['hash'=>$size->hash,'name'=>$size->name])->update([
                'name'=>$request->size,
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
           
            $size = ProductSize::find($id);
            if (!$size)
                return redirect()->route('vendor.color.show', $id)->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
            ProductSize::where(['hash'=>$size->hash,'name'=>$size->name])->delete();
            return redirect()->route('vendor.product.index')->with(['success' => 'تم حذف البيانات بنجاح']);

         }
         catch(Exception $exp){
            return $exp;
            return  redirect()->route('vendor.product.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
         }
    }
}
