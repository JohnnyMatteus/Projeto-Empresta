<?php
namespace App\Http\Traits;

trait traitErrorData
{
    public function generate($code, $description, $name, $statusCode)
    {
        $data = [
            'code' => $code,
            'description' => $description,
            'name' => $name,
            'statuscode' => $statusCode
        ];
        return $data;
    }
}