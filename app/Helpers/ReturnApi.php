<?php

namespace App\Helpers;

class ReturnApi{

    public function responseApi($statusCode, $data){
        return response()
            ->json($data)
            ->setStatusCode($statusCode);
    }

}
