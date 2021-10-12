<?php

namespace App\Http\Controllers\UserApi;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Mockery\Expectation;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    function __construct()
    {

        $this->middleware('assign.guard:api', ['except' => ['login', 'register']]);
    }
    use GeneralTrait;



    public function login(Request $request)
    {

        try {


            $rule = [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ];


            $validator = Validator::make($request->all(), $rule);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('api')->attempt($credentials);

            if (!$token) {
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');
            }

            $user = Auth::guard('api')->user();
            $user->api_token = $token;

            return $this->returnData('user', $user,);
        } catch (\Exception $ex) {

            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function register(Request $request)
    {

        try {
            $rule = [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|confirmed|min:6',
            ];

            $validator = Validator::make($request->all(), $rule);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $user = User::create(array_merge(
                $validator->validated(),
                [
                'password' => $request->password,
                ]
            ));

            $token = JWTAuth::fromUser($user);
            $user->api_token = $token;
            return $this->returnData('user', $user);
        } catch (\Exception $exp) {

            return $this->returnError($exp->getCode(), $exp->getMessage());
        }
    }



    public function logout(Request $request)
    {


        $token = $request->header('auth-token');

        if ($token) {
            try {

                JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMessage('تم  تسجيل الخروج بنجاح');
            } catch (TokenInvalidException $exp) {

                return  $this->returnError('', 'some thing went wrongs');
            }
        } else
            $this->returnError('', 'some thing went wrongs');
    }



   
    public function updateProfile(Request $request){
       
    

      try{
        
        $user=Auth::user();
       
        $rule=[ 
         'last_name'=>'required|string|between:2,100',  
         'photo' => 'required_without:id|mimes:jpg,jpeg,png,svg',
         'phone'=>'required|max:100|unique:users,phone,'.Auth::user()->id,
          
          ];
          $validator = Validator::make( $request->except('name', 'email', 'password'), $rule);
         
          if ($validator->fails()) {
           $code = $this->returnCodeAccordingToInput($validator);
           return $this->returnValidationError($code, $validator);
          }
          
           $user->update($request->all());

           return $this->returnSuccessMessage('تم تعديل البيانات  بنجاح');
    


      }
      catch(Exception $exp){
        return $this->returnError($exp->getCode(), $exp->getMessage());
      }


    }




   public function cheekToken(){
         
    try{
       return $this->returnSuccessMessage('تم المصادقة بنجاح');
      
    }
     catch (Exception $exp){
        return $this->returnError('', 'Page must be refreshed');
      
    }
    
   

   }


   public function profileUser(){
       try{
        return $this->returnData('users',  Auth::user());
       }
       catch(Expectation $mes){
        return $this->returnError('', 'Page must be refreshed');
       }

   
    
   }
}
