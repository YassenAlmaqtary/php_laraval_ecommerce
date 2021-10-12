<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\photoRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductPhoto;
use App\Models\ProductSize;
use App\Models\Size;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PhotosController extends Controller
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
        try {
            $vendor_id = Auth::guard('vendor')->user()->id;
            $Products = Product::where(['vendor_id' => $vendor_id, 'translation_lang' => get_defoult_langug()])->select('id', 'name')->get();
            $colors = Color::get();
            $sizes=Size::get();
            return view('vendor.photos_product.create', compact('Products', 'colors','sizes'));
        } catch (Exception $exp) {
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        try {
         if (!$request->has('photo')&& !$request->has('colors')&& !$request->has('sizes'))
            return redirect()->route('vendor.photo.create')->with(['error' => 'يجب ملى حقل واحد على الاقل  اما صورة او لون او حجم']);
            
            $filePathes = '';
            $has_color='';
             $hash_size='';
            DB::beginTransaction();

            if ($request->has('photo')) {
                $filePathes = uploadImage('products', $request->photo);
                ProductPhoto::create([
                    'product_id' => $request->product,
                    'path' => $filePathes,

                ]);
            }

            if ($request->has('colors')) {
                $has_color=rand();
                $color_arry = [];
                $colors = $request->colors;
                foreach ($colors as $color) {
                    $color_arry[] = [
                        'hex' => $color,
                        'hash'=>$has_color,
                        'product_id' => $request->product,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),

                    ];
                }
                ProductColor::insert($color_arry);
            }

         
        
            if ($request->has('sizes')) {
              
                $sizes = $request->sizes;
                $hash_size=rand(); 
                $size_arry = [];
                foreach ($sizes as $size) {
                    $size_arry[] = [
                        'name' => $size,
                        'hash'=>$hash_size,
                        'product_id' => $request->product,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }

                ProductSize::insert($size_arry);
            }


            $subProducts = Product::find($request->product)->products()->select('id')->get();

            if ($subProducts->count() > 0 && $request->has('photo')) {
                $file_arry = [];
                foreach ($subProducts as $subProduct) {
                    $file_arry[] = [
                        "product_id" => $subProduct->id, "path" => $filePathes, 'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    ProductPhoto::insert($file_arry);
                }
            }
          

            if ($subProducts->count() > 0 && $request->has('colors')) {
                $color_arry = [];
                $colors = $request->colors;
                foreach ($subProducts as $subProduct) {
                    foreach ($colors as $color) {
                        $color_arry[] = [
                            'hex' => $color,
                            'hash'=>$has_color,
                            'product_id' => $subProduct->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),

                        ];
                    }
                    ProductColor::insert($color_arry);
                }
            }
           

            if ($subProducts->count() > 0 && $request->has('sizes')) {
                return $request;
                $size_arry = [];
                $sizes = $request->sizes;
                foreach ($subProducts as $subProduct) {
                    foreach ($sizes as $size) {
                        $size_arry[] = [
                            'name' => $size,
                            'hash'=>$hash_size,
                            'product_id' => $subProduct->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),

                        ];
                    }
                    ProductSize::insert($size_arry);
                }
            }

            DB::commit();
            return  redirect()->route('vendor.product.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $exp) {
             return $exp;
            if($request->has('photo'))
              removeImage($filePathes);
            return  redirect()->route('vendor.product.create')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
        try {

            $product = Product::find($id);
            if (!$product)
                return redirect()->route('vendor.product.index')->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
            $name_product = $product->name;
            $photos = $product->photos;

            return view('vendor.photos_product.show', compact('photos', 'name_product'));
        } catch (Exception $exp) {
            
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

            $photos = ProductPhoto::find($id);

            if (!$photos)
                return redirect()->route('vendor.product.index')->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
            $name_product = $photos->product->name;

            return view('vendor.photos_product.ubdate', compact('photos', 'name_product'));
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
    public function update(photoRequest $request, $id)
    {
        try {
            $path = ProductPhoto::find($id)->path;

            if (!$path)
                return redirect()->route('vendor.product.index')->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);
            DB::beginTransaction();
            $filePath = $path;
            if ($request->has('photo')) {
                removeImage($filePath);
                $filePath = uploadImage('products', $request->photo);
                ProductPhoto::where('path', $path)->update([
                    'path' => $filePath,
                    'updated_at' => Carbon::now(),

                ]);
            }
            DB::commit();
            return redirect()->route('vendor.product.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $exp) {
            DB::rollback();
            removeImage($filePath);
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
        try {
            $product_id = ProductPhoto::find($id)->product_id;
            if (!$product_id)
                return redirect()->route('vendor.photo.show', $id)->with(['error' => 'هذا القسم غير موجود او ربما تم حذفة']);

            if (ProductPhoto::where('product_id', $product_id)->get()->count() > 1) {

                $path = ProductPhoto::find($id)->path;
                removeImage($path);
                ProductPhoto::where('path', $path)->delete();

                return redirect()->route('vendor.product.index')->with(['success' => 'تم حذف البيانات بنجاح']);
            }

            return redirect()->route('vendor.product.index')->with(['error' => 'يجب ان تبقى صورة واحدة على الاقل']);

        } 
        catch (Exception $exp) {
            return  redirect()->route('vendor.product.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    

}
