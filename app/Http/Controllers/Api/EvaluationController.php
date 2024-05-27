<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluation;
use App\Http\Resources\EvaluationResource;
use App\Jobs\EvaluationCreated;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Services\CompanyService;

class EvaluationController extends Controller
{
    protected $evaluation;
    protected $companyService;

    public function __construct(Evaluation $evaluation, CompanyService $companyService)
    {
        $this->evaluation = $evaluation;
        $this->companyService = $companyService;
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

    public function store(StoreEvaluation $request, $company){

        $response = $this->companyService->getCompany($company);    

        $status = $response->status();
        if($status != 200) {
            return response()->json([
                'message' => 'Company inválida'
                ], $status);
        }

        $company = json_decode($response->body());

        $evaluation = $this->evaluation->create($request->validated());

        EvaluationCreated::dispatch($company->data->email)->onQueue('queue_email');

        return new EvaluationResource($evaluation);

    }
}
