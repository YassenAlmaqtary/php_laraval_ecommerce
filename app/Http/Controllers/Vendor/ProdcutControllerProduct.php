<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\MainCategorie;
use App\Models\Product;
use App\Models\SubCategorie;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdcutControllerProduct extends Controller
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
        
        $products=Product::where(['vendor_id'=>Auth::user()->id])->selection()->get();
        //return $products;
        return  view('vendor.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor=Auth::guard('vendor')->user();
        $mamCategory_id= $vendor->category->id;
        $sub_categories=MainCategorie::find($mamCategory_id)->Subctegorys()->where('translation_of', 0)->select('id', 'name')->get();
        $vendor_id= $vendor->id;
         return  view('vendor.product.create',compact('sub_categories','mamCategory_id','vendor_id'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




     
    public function store(ProductRequest $request)
    {
         try{
             
          $product=collect($request->product);
          $filter = $product->filter(function ($value, $key) {
            return $value['abbr'] == get_defoult_langug();
        }
        );
         
         $default_product = array_values($filter->all())[0];
         $filePathes =[];
         if ($request->has('photo')) {
          $filePathes = uploadMultiImage('products', $request->photo);
          removeMultiImage($filePathes);

          return $filePathes;


         }

         }
         catch(Exception $exp){

         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
