<?php

namespace App\Http\Controllers\Trait;

trait DataTrait{

    //طريقة جلب البيانات وعرضها 
    
    public function Data($data = null , $message = null , $status = null)
    {
        $array =[
        'message' => $message,
        'data' => $data, 
        'status' => $status
        ];

        return response($array,$status);
    }
}
