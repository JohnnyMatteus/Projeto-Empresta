<?php

namespace App\Http\Controllers;

use App\Models\Covenants;
use Illuminate\Http\Request;
use App\Http\Traits\traitErrorData;
use App\Http\Interfaces\IListCovenants;

class CovenantsController extends Controller
{
    private $finder;
    use traitErrorData;
    public function __construct(IListCovenants $listCovenants)
    {
        $this->finder = $listCovenants;
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
            return response()->json($this->generate('not_covenants', $th->getMessage(), 'Not covenants', '401'));
        }
    }

}
