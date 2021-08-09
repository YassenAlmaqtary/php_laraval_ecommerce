<?php

use App\Models\Languge;
use Illuminate\Support\Facades\App;

function getLanguges(){

  return Languge::active()->selection()->get();
}


function set_Locale($locale)
{
  
   App::setLocale($locale);

}


function get_defoult_langug(){

    return App::getLocale();

}


function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path ='/assets/admin/images/'. $folder . '/' . $filename;
    return $path;
}

function removeImage($path){

  if(file_exists(public_path().$path))
   unlink(public_path().$path);

}
 



 function get_url_image($value){
   
  return ($value!=null)?asset($value):"";
} 
