<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategorieRequest;
use App\Models\MainCategorie;
use App\Models\SubCategorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Claims\Subject;

class SubCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $defual_lang = get_defoult_langug();
        $sub_categories = SubCategorie::where('translation_lang', $defual_lang)->selection()->get();
       
        return view('admin.subcategories.index', compact('sub_categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_categories = MainCategorie::where('translation_of', 0)->select('id', 'name')->get();


        return view('admin.subcategories.create', compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategorieRequest $request)
    {
        try {

                     

            $sub_category = collect($request->subcategory);
           

            $filter = $sub_category->filter(function ($value, $key) {
                return $value['abbr'] == get_defoult_langug();
            });
            

            $default_category = array_values($filter->all())[0];
            

            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('subcategories', $request->photo);
            }

            DB::beginTransaction();

            $default_category_id = SubCategorie::insertGetId(
                [
                    'translation_lang' => $default_category['abbr'],
                    'main_categorie_id'=>$request->main_categorie_id,
                    'translation_of' => 0,
                    'name' => $default_category['name'],
                    'slug' => '/' . $default_category['name'],
                    'photo' => $filePath,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ]

            );



            $subcategorys = $sub_category->filter(function ($value, $key) {
                return $value['abbr'] != get_defoult_langug();
            });
            
        

            if (isset($subcategorys) && $subcategorys->count()) {

                $categorys_arry = [];

                foreach ($subcategorys as $subcategory) {
                

                    $categorys_arr[] = [
                        'translation_lang' => $subcategory['abbr'],
                        'main_categorie_id'=>$request->main_categorie_id,
                        'translation_of' => $default_category_id,
                        'name' => $subcategory['name'],
                        'slug' => '/' . $subcategory['name'],
                        'photo' => $filePath,
                        'created_at'=>Carbon::now(),
                        'updated_at'=>Carbon::now(),

                    ];
                }

                SubCategorie::insert($categorys_arr);
            }

            DB::commit();

            return  redirect()->route('admin.sub-cstegorys')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {

            // unlink($filePath);
            DB::rollBack();

            return  redirect()->route('admin.sub-cstegorys')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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

        try{
            $SubCategory=SubCategorie::with('categorys')->selection()->find($id);
            $main_categories = MainCategorie::where('translation_of', 0)->select('id', 'name')->get();
        
            if(!$SubCategory)
             return redirect()->route('admin.sub-cstegorys')->with(['error'=>'هذة القسم غير موجودة']);
             return view('admin.subcategories.ubdate',compact('SubCategory','main_categories')); 
           }
           catch(Exception $exp){

            return  redirect()->route('admin.cstegorys')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);


           }
        


        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategorieRequest $request, $id)
    {
        try{
            
            
            $sub_category= SubCategorie::find($id);
    
            if(!$sub_category)
              return redirect()->route('admin.sub-cstegorys')->with(['error'=>'هذة القسم غير موجودة']);
              $subCategory=$request->subcategory[0];
            
              if (!$request->has('subcategory.0.active'))
                
                  $request->request->add(['active' => 0]);
              else
                   $request->request->add(['active' => 1]);
              
              $filePath=$sub_category->photo;
        
              if ($request->has('photo')) {
                
                removeImage($filePath);
              
                $filePath = uploadImage('subcategories', $request->photo);
            }
            

            
            
              SubCategorie::where('id',$id)->update(
                [
              'main_categorie_id'=> $sub_category->main_categorie_id,   
               'name'=> $subCategory['name'],
               'active'=>$request->active,
               'photo'=>$filePath,
               'slug' => '/'.$subCategory['name'],
               //'created_at'=>Carbon::now(),
               'updated_at'=>Carbon::now(),
              ]
            );
              $categorys=$sub_category->categorys;
              
              if(isset($categorys)&&$categorys->count()>0){
                 
                foreach($categorys as $category){
                    
                SubCategorie::where('translation_of',$id)->update(
                [    
                 
                'id'=>  $category['id'],
                'main_categorie_id'=> $category['main_categorie_id'],   
                'photo'=>$filePath,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(), 
                ]
                );
    
                }
              }
              else{
               return  redirect()->route('admin.sub-cstegorys')->with(['error' => 'لايمكن تعديل الصورة لا من اللغة الافتراضية فقط وهي اللغة العربية']);
              } 
              
              return  redirect()->route('admin.sub-cstegorys')->with(['success' => 'تم التحديث بنجاح']);
           }
          catch(Exception $exp){
            return $exp;
    
            return  redirect()->route('admin.cstegorys')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    
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
