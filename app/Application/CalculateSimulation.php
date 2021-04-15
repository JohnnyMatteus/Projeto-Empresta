<?php

namespace App\Application;

use App\Http\Interfaces\ICalculateSimulation;
use App\Http\Interfaces\IListTaxasInstituitions;
use App\Http\Requests\TaxasInstituitionsRequest;

class CalculateSimulation implements ICalculateSimulation
{
    private $repository;

    public function __construct(IListTaxasInstituitions $fees)
    {
        $this->repository = $fees;
    }
    function execute(TaxasInstituitionsRequest $request)
    {
        $data = [];
        
        foreach ($this->repository->list() as $item) {       
            if ($request->instituicoes) {                          
                foreach ($request->instituicoes as $value) {                    
                    if ($value["name"] == $item->instituicao) {                       
                        $data[$item->instituicao][] = $this->prepareArray($item, $request->valor_emprestimo);
                    }
                }
            } 
            if ($request->convenios) {                
                foreach ($request->convenios as $value) {                    
                    if ($value["name"] == $item->convenio) {                       
                        $data[$item->instituicao][] = $this->prepareArray($item, $request->valor_emprestimo);
                    }
                }
            }   
            if ($request->parcela) {
                if ($request->parcela == $item->parcelas) {                       
                    $data[$item->instituicao][] = $this->prepareArray($item, $request->valor_emprestimo);
                }
            } 
            if(!$request->parcela && !$request->convenios && !$request->instituicoes) {
                $data[$item->instituicao][] = $this->prepareArray($item, $request->valor_emprestimo);
            }
            
        }
        return $data;
    }

    private function calculate($value, $coefiente)
    {
        return $value * $coefiente;
    }

    private function prepareArray($data, $value)
    {
        return [
            'taxa' => $data->taxaJuros,
            'parcelas' => $data->parcelas,
            'valor_parcala' => $this->calculate($value, $data->coeficiente),
            'convenio' => $data->convenio
        ];
    }

}
