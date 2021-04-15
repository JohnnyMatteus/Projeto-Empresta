<?php

namespace App\Infrastructure\PersistenceViaJson;

use App\Http\Interfaces\IListCovenants;

class CovenantsRepository implements IListCovenants
{
    private $repository = array();
    function __construct()
    {
        $repositoryJson = file_get_contents(base_path('resources/data/convenios.json'));
        $this->repository = json_decode($repositoryJson);        
    }

    function list()
    {        
        return $this->repository;        
    }
    
}
