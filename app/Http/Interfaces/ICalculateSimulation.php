<?php
namespace App\Http\Interfaces;

use App\Http\Requests\TaxasInstituitionsRequest;

interface ICalculateSimulation
{
    function execute(TaxasInstituitionsRequest $request);
}