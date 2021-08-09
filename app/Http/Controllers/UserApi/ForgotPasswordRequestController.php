<?php

namespace App\Http\Controllers\UserApi;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordRequestController extends Controller
{
    use SendsPasswordResetEmails,GeneralTrait;

   


    protected function sendResetLinkResponse(Request $request, $response)
    {
            
            return $this->returnSuccessMessage(__($response),200);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {    
        return $this->eturnError(422,__($response) );
    }



    
}
