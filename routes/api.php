<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    EvaluationController
};

Route::get('/evaluations/{company}', [EvaluationController::class, 'index']);

Route::get('/' , function(){
    return response()->json(['message' => 'sucesso micro02']);
});

