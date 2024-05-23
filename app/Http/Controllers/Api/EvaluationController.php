<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EvaluationResource;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    protected $evaluation;

    public function __construct(Evaluation $evaluation)
    {
        $this->evaluation = $evaluation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company)
    {
        $evaluations = $this->evaluation->where('company', $company)->get();

        return EvaluationResource::collection($evaluations);
    }
}
