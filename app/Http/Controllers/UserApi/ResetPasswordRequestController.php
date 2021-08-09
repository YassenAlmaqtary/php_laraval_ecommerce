<?php

namespace App\Http\Controllers\UserApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;

use Illuminate\Foundation\Auth\ResetsPasswords;


class ResetPasswordRequestController extends Controller
{
    use GeneralTrait,ResetsPasswords;



    protected function sendResetResponse(Request $request, $response)
    {    
        
            return $this->returnSuccessMessage(__($response),200);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return $this->eturnError(422,__($response) );
    }


}