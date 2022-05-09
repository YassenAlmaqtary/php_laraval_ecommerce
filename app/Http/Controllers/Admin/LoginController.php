<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {

      $this->middleware('guest:admin')->except('logout');
      
    }
  
    public function getLogin(){

      return view('admin.auth.login');

    }

    
   public function Login(LoginRequest $request){
    
    $remember_me = $request->has('remember_me') ? true : false;
    
    if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
        // notify()->success('تم الدخول بنجاح  ');
         return redirect()->intended( route('admin.dashboard'));
     }
    // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
     return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
 }



 public function logout( Request $request )
{

    
    if(Auth::guard('admin')->check()) // this means that the admin was logged in.
    {
        Auth::guard('admin')->logout();
        return redirect()->route('get.admin.login');
    }

    $this->guard()->logout();
    $request->session()->invalidate();

    return $this->loggedOut($request) ?: redirect()->route('get.admin.login');
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



