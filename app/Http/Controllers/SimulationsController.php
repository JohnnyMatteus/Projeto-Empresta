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
            //return response()->json($request);

        } catch (\Throwable $th) {
            return response()->json($this->generate('not_covenants', $th->getMessage(), 'Not covenants', '401'));
        }
        
    }
    public function list()
    {
        $data = [];
        foreach($this->finder->list() as $item)
        {
           $data[$item->instituicao][] = [
                   'taxa' => $item->taxaJuros,
                   'parcelas' => $item->parcelas,
                   'valor_parcala' => 30500.00 * $item->coeficiente,
                   'convenio' => $item->convenio               
           ];
 
        }
        dd($data);
        // try {
        //     return response()->json($this->finder->list());

        // } catch (\Throwable $th) {
        //     return response()->json($this->generate('not_covenants', $th->getMessage(), 'Not covenants', '401'));
        // }
        
    }
}
