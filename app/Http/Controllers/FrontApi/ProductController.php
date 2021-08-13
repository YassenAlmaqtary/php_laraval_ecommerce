<?php

namespace App\Http\Controllers\FrontApi;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ProductController extends Controller
{



   public function getProuductWithVendor($vendo_id){

   $ven=Vendor::find($vendo_id);


   }


}
