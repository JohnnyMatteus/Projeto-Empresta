<?php

namespace App\Infrastructure\PersistenceViaJson;

use App\Http\Interfaces\IListTaxasInstituitions;

class TaxaInstituitionsRepository implements IListTaxasInstituitions
{
    private $repository = array();
    function __construct()
    {
        $repositoryJson = file_get_contents(base_path('resources/data/TaxaInstituitionsRepository.json'));
        $this->repository = json_decode($repositoryJson);        
    }

    function list()
    {        
        return $this->repository;        
    }
    
}
