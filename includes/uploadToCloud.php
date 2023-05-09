<?php


include_once("./bootstrap.php");

require './vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;





function uploadFileCloud($file){ 
    $link = " ";
    $errors= array();
    $file_name = $file['name'];
    $file_size =$file['size'];
    $file_tmp =$file['tmp_name'];
    $file_type=$file['type'];
    
    $fileData = explode('/', $file_type);
    $fileExtension = $fileData[count($fileData) - 1];
    
    $extensions= array("jpeg","jpg","png");
    
    $target = dirname( dirname(__FILE__) );
    $file_name = $target . '/images/' . basename($file_name);

    $uploaded = move_uploaded_file($file_tmp, $file_name);

   
    if ($uploaded = 1) {
        $data = (new UploadApi())->upload($file_name);
        return $data['secure_url'];
    }
    else {
        $errors = "There was an error uploading the file";
        return $errors;
    }

    
    echo $file_name;


}





