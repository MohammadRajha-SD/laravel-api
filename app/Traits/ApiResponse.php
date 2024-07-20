<?php 
namespace App\Traits;


trait ApiResponse {

    public function ApiResponseTrait($data = [], $msg = null, $status = null) {

        return response(
            [
                'data'=> $data,
                'message'=> $msg,
                'status'=> $status
            ], $status
        );
    }
}