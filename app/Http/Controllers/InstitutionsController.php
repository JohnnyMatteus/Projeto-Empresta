<?php

namespace App\Http\Controllers;

use App\Models\Institutions;
use Illuminate\Http\Request;
use App\Http\Traits\traitErrorData;
use App\Http\Interfaces\IListInstituitions;

class InstitutionsController extends Controller
{
    private $finder;
    use traitErrorData;

    public function __construct(IListInstituitions $listInstituitions)
    {
        $this->finder = $listInstituitions;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json($this->finder->list());
        } catch (\Throwable $th) {            
            return response()->json($this->generate('not_instituitions', $th->getMessage(), 'Not instituitions', '401'));
        }
    }
    
}
