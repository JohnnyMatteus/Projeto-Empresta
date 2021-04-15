<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ICalculateSimulation;
use Illuminate\Http\Request;
use App\Http\Traits\traitErrorData;
use App\Http\Interfaces\IListTaxasInstituitions;
use App\Http\Requests\TaxasInstituitionsRequest;


class SimulationsController extends Controller
{
    private $finder;
    private $calculate;
    use traitErrorData;
    public function __construct(IListTaxasInstituitions $fees, ICalculateSimulation $calculate)
    {
        $this->finder = $fees;
        $this->calculate = $calculate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaxasInstituitionsRequest $request)
    {
        try {
            $request->validated();            
            return response()->json($this->calculate->execute($request));
          

        } catch (\Throwable $th) {
            return response()->json($this->generate('not_covenants', $th->getMessage(), 'Not covenants', '401'));
        }
        
    }    
}
