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


function uploadMultiImage($folder,$images)
{
  $pathes=[];
   foreach ($images as $index=>$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    $pathes[$index] ='/assets/admin/images/'. $folder . '/' . $filename;
   }
   return $pathes;
}

function removeImage($path){
  //if(file_exists(base_path().$path))
  if(file_exists(public_path().$path))
  //unlink(base_path().$path);
   unlink(public_path().$path);

}


function removeMultiImage($paths){

  
   foreach($paths as $path){
     //if(file_exists(base_path().$path))
    if(file_exists(public_path().$path))
      //unlink(base_path().$path);
       unlink(public_path().$path);
   }
  

}
 



 function get_url_image($value){
   
  return ($value!=null)?asset($value):"";
} 


function nullSercheValueincollect($array,$value){

   $statues=true;
   foreach($array as $val ){
     if($val==$value){
     $statues=false;
     break;
     }
   }
   return $statues;
}
