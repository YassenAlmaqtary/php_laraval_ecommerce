<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorLoginController extends Controller
{
    public function __construct()
    {

      $this->middleware('guest:vendor')->except('logout');
      
    }
  
    public function getLogin(){

      return view('vendor.auth.login');

    }

    
   public function Login(LoginRequest $request){
     
        
    $remember_me = $request->has('remember_me') ? true : false;
    
    if (auth()->guard('vendor')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
        // notify()->success('تم الدخول بنجاح  ');
         return redirect()->intended( route('vendor.vendors'));
     }
    // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
     return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
 }



 public function logout( Request $request )
{

    
    if(Auth::guard('vendor')->check()) // this means that the admin was logged in.
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('get.vendor.login');
    }

    $this->guard()->logout();
    $request->session()->invalidate();

    return $this->loggedOut($request) ?: redirect()->route('get.vendor.login');
}
  



 /*public function save(){

  $admin = new Admin();
  $admin -> name ="admin";
  $admin -> email ="admin@gmail.com";
  $admin -> password = bcrypt("aaaaaaaa8");
  $admin -> save();

}
*/


   }



