<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\MainCategorie;
use App\Models\Product;
use App\Models\ProductPhoto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $products = Product::where(['vendor_id' => Auth::user()->id, 'translation_lang' => get_defoult_langug()])->selection()->get();
        //return $products;
        return  view('vendor.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = Auth::guard('vendor')->user();
        $mamCategory_id = $vendor->category->id;
        $sub_categories = MainCategorie::find($mamCategory_id)->Subctegorys()->where('translation_of', 0)->select('id', 'name')->get();
        $vendor_id = $vendor->id;
        return  view('vendor.product.create', compact('sub_categories', 'mamCategory_id', 'vendor_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */





    public function store(ProductRequest $request)
    {
        try {


            $product = collect($request->product);
            $filter = $product->filter(
                function ($value, $key) {
                    return $value['abbr'] == get_defoult_langug();
                }
            );

            $default_product = array_values($filter->all())[0];

            $filePathes = [];
            if ($request->has('photo')) {
                $filePathes = uploadMultiImage('products', $request->photo);
            }


            DB::beginTransaction();

            $default_product_id = Product::insertGetId(
                [
                    'name' => $default_product['name'],
                    'translation_of' => 0,
                    'vendor_id' => $request->vendor_id,
                    'main_categorie_id' => $request->mamCategory_id,
                    'sub_categorie_id' => $request->sub_categories_id,
                    'description' => $default_product['description'],
                    'price' => $default_product['price'],
                    'descount' => $default_product['descount'],
                    'quntity' => $default_product['quntity'],
                    'slug' => '/' . $default_product['name'],
                    'translation_lang' => $default_product['abbr'],
                    'active' => $default_product['active'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]

            );


            $file_arry = [];

            if (count($filePathes) > 0) {

                foreach ($filePathes as $path) {
                    $file_arry[] = [
                        "product_id" => $default_product_id, "path" => $path, 'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }

                ProductPhoto::insert($file_arry);
            }

            $products = $product->filter(
                function ($value, $key) {
                    return $value['abbr'] != get_defoult_langug();
                }
            );


            if (isset($products) && $products->count()) {
                $product_arry = [];
                foreach ($products as $product) {
                    $product_arry[] = [
                        'name' => $product['name'],
                        'vendor_id' => $request->vendor_id,
                        'main_categorie_id' => $request->mamCategory_id,
                        'sub_categorie_id' => $request->sub_categories_id,
                        'translation_of' => $default_product_id,
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'descount' => $product['descount'],
                        'quntity' => $product['quntity'],
                        'slug' => '/' . $product['name'],
                        'translation_lang' => $product['abbr'],
                        'active' => $product['active'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }


                $products_id = Product::insertGetId($product_arry[0]);


                $file_arry = [];

                if (count($filePathes) > 0) {

                    foreach ($filePathes as $path) {
                        $file_arry[] = [
                            "product_id" => $products_id, "path" => $path, 'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                    ProductPhoto::insert($file_arry);
                }
            }

            DB::commit();
            return  redirect()->route('vendor.product.index')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $exp) {

            DB::rollBack();
            removeMultiImage($filePathes);
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
            $products = Product::find($id);

            if (!$products)
                return redirect()->route('vendor.product.index')->with(['error' => 'هذة القسم غير موجودة']);

            return view('vendor.product.ubdate', compact('products'));
        } catch (Exception $exo) {
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
    public function update(ProductRequest $request, $id)
    {
        try {


            $product_with_id = Product::find($id);
            if (!$product_with_id)
                return redirect()->route('vendor.product.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

            $product = $request->product[0];
            if (!$request->has('product.0.active'))

                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            Product::where('id', $product_with_id->id)->update(
                [
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'descount' => $product['descount'],
                    'quntity' => $product['quntity'],
                    'slug' => '/' . $product['name'],
                    'translation_lang' => $product['abbr'],
                    'active' => $request->active,
                    'updated_at' => Carbon::now(),
                ]

            );
            return  redirect()->route('vendor.product.index')->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $exp) {

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
        //
    }
}
