<?php

namespace App\Infrastructure\PersistenceViaJson;

use App\Http\Interfaces\IListInstituitions;

class InstiuitionsRepository implements IListInstituitions
{
    private $repository = array();
    function __construct()
    {
        $repositoryJson = file_get_contents(base_path('resources/data/instituicoes.json'));
        $this->repository = json_decode($repositoryJson);        
    }

    function list()
    {        
        return $this->repository;        
    }
    
}
