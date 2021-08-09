<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategorie;
use App\Models\Vendor;
use App\Notifications\VendorCreated;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class VendorControllerVendor extends Controller
{


    public function __construct()
    {
             
    $this->middleware('auth:vendor')->except(['create','store']);

    }
    
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Auth::user();
        

        return view('vendor.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MainCategorie::active()->where('translation_of', 0)->get();
        return view('vendor.vendors.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {


        try {

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
           /* else
                $request->request->add(['active' => 1]);
            */

            $filePath = "";
            if ($request->has('logo')) {
                $filePath = uploadImage('vendors', $request->logo);
            }


            $vendor = Vendor::create([
                
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'address' => $request->address,
                'logo' => $filePath,
                'password' => $request->password,
                'main_categorie_id' => $request->main_categorie_id,
                'company_name' => $request->company_name
            ]);

            Notification::send($vendor, new VendorCreated($vendor));

            return redirect()->route('get.vendor.login')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('vendor.vendors.create')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
        try {

            $vendor = Vendor::selection()->find($id);

            $categories = MainCategorie::where('translation_of', 0)->selection()->get();


            if (!$vendor & !$categories)
                return redirect()->route('vendor.vendors')->with(['error' => 'هذة  غير موجودة']);


            return view('vendor.vendors.ubdate', compact('vendor', 'categories'));
        } catch (Exception $exp) {

            return redirect()->route('vendor.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {

        try {
           
            $vendor = Vendor::find($id);
            if (!$vendor)
                return redirect()->route('vendor.vendors')->with(['error' => 'هذة  غير موجودة']);

            DB::beginTransaction();  

           /* if (!$request->has('active'))

                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);
                */

            $filePath = $vendor->logo;
            $password = $vendor->password;

            if ($request->has('logo')) {
                removeImage($filePath);
                $filePath = uploadImage('vendors', $request->logo);
                Vendor::where('id', $id)->update(['logo' => $filePath,]);
            }

            $data = $request->except('_token', 'id', 'logo', 'password','_method','latitude','longitude');
          

            if ($request->has('password') && !is_null($request->password)) {
                $password = bcrypt($request->password);
                $data['password'] = $password;
            }
            Vendor::where('id', $id)->update($data);

            DB::commit();
            return redirect()->route('vendor.vendors')->with(['success' => 'تم الحفظ بنجاح']);

        } 
        catch (Exception $exp) {
            return $exp; 
            DB::rollback();
            return redirect()->route('vendor.vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

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
    }
}
