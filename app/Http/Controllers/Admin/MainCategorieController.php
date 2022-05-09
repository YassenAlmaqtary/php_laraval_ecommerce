<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategorie;
use App\Models\SubCategorie;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class MainCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $defual_lang = get_defoult_langug();
        $categories = MainCategorie::where('translation_lang', $defual_lang)->selection()->get();

        return view('admin.maincategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.maincategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {
        try {


            $main_category = collect($request->category);


            $filter = $main_category->filter(function ($value, $key) {
                return $value['abbr'] == get_defoult_langug();
            });


            $default_category = array_values($filter->all())[0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('maincategories', $request->photo);
            }

            DB::beginTransaction();

            $default_category_id = MainCategorie::insertGetId(
                [
                    'translation_lang' => $default_category['abbr'],
                    'translation_of' => 0,
                    'name' => $default_category['name'],
                    'slug' => '/' . $default_category['name'],
                    'photo' => $filePath,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]

            );



            $categorys = $main_category->filter(function ($value, $key) {
                return $value['abbr'] != get_defoult_langug();
            });

            if (isset($categorys) && $categorys->count()) {

                $categorys_arry = [];

                foreach ($categorys as $category) {

                    $categorys_arr[] = [
                        'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => '/' . $category['name'],
                        'photo' => $filePath,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),

                    ];
                }

                MainCategorie::insert($categorys_arr);
            }

            DB::commit();

            return  redirect()->route('admin.cstegorys')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {

            DB::rollBack();
            removeImage($filePath);
            return  redirect()->route('admin.cstegorys')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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

            $subcategories = MainCategorie::find($id)->Subctegorys()->where('translation_of', 0)->get();
            if (!$subcategories || $subcategories->count() == 0) {
                return redirect()->route('admin.cstegorys')->with(['error' => 'هذة القسم الفرعي غير موجودة']);
            }

            return view('admin.maincategories.subcategory', compact('subcategories'));
        } catch (Exception $exp) {
            return  redirect()->route('admin.sub-cstegorys')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
            $mainCategory = MainCategorie::with('categorys')->selection()->find($id);

            if (!$mainCategory)
                return redirect()->route('admin.cstegorys')->with(['error' => 'هذة القسم غير موجودة']);
            return view('admin.maincategories.ubdate', compact('mainCategory'));
        } catch (Exception $exp) {

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
    public function update(MainCategoryRequest $request, $id)
    {

        try {

            $main_category = MainCategorie::find($id);

            if (!$main_category)
                return redirect()->route('admin.cstegorys')->with(['error' => 'هذة القسم غير موجودة']);
            $category = $request->category[0];

            if (!$request->has('category.0.active'))

                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = $main_category->photo;
            if ($request->has('photo')) {

                removeImage($filePath);
                $filePath = uploadImage('maincategories', $request->photo);
            }

            MainCategorie::where('id', $id)->update([
                'name' => $category['name'],
                'active' => $request->active,
                'photo' => $filePath,
                'slug' => '/' . $category['name'],
                'updated_at' => Carbon::now(),

            ]);

            $categorys = $main_category->categorys;


            if (isset($categorys) && $categorys->count() > 0) {

                foreach ($categorys as $category) {

                    MainCategorie::where('translation_of', $id)->update(
                        [
                            'id' =>  $category['id'],
                            'photo' => $filePath,
                            'updated_at' => Carbon::now(),
                        ]
                    );
                }
            } else {
                return  redirect()->route('admin.cstegorys')->with(['error' => 'لايمكن تعديل الصورة الا من اللغة الافتراضية فقط وهي اللغة العربية']);
            }

            return  redirect()->route('admin.cstegorys')->with(['success' => 'تم التحديث بنجاح']);
        } catch (Exception $exp) {

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
