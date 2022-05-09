<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LangugeRequest;
use App\Models\Languge;
use Illuminate\Http\Request;
use Mockery\Expectation;

class LangugeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
      $languges=Languge::select()->paginate(PAGNATION_COUNT);

        return view('admin.languges.index',compact('languges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LangugeRequest $request)
    {    

        try{
            Languge::create($request->except(['_token']));
            
            return redirect()->route('admin.languges')->with(['success'=>'تم حفظ اللغة بنجاح']);
        }
        catch(Expectation $ex){

            return redirect()->route('admin.languges')->with(['error'=>'هناك خطاء يجب اصلاحة']);
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Rescatch(Expectation $ex)
    {}ponse
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
        $languges=Languge::select()->find($id);
       
        if(!$languges)
         return redirect()->route('admin.languges')->with(['error'=>'هذة اللغة غير موجودة']);
 
         return view('admin.languges.ubdate',compact('languges'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LangugeRequest $request, $id)
    {
        
        try{

            $languges=Languge::find($id);
       
            if(!$languges)
             return redirect()->route('admin.languges')->with(['error'=>'هذة اللغة غير موجودة']);
    
             if (!$request->has('active'))
                    $request->request->add(['active' => 0]);
    
            return $languges;
            $languges->update($request->except(['_token']));
            
            return redirect()->route('admin.languges')->with(['success'=>'تم تعديل اللغة بنجاح']);
        }
        catch(\Exception $ex){

            return redirect()->route('admin.languges')->with(['error'=>'هناك خطاء يجب اصلاحة']);
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
            $languges=Languge::find($id);
       
            if(!$languges)
             return redirect()->route('admin.languges')->with(['error'=>'هذة اللغة غير موجودة']);
    

            $languges->delete();
            
            return redirect()->route('admin.languges')->with(['success'=>'تم حذف اللغة بنجاح']);
        }
        catch(\Exception $ex){

            return redirect()->route('admin.languges')->with(['error'=>'هناك خطاء يجب اصلاحة']);
        }


    }
}
