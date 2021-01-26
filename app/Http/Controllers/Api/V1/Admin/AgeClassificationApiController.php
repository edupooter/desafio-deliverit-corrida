<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\RunnersResult;
use App\Models\AgeClassification;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Admin\ClassificationResource;

class AgeClassificationApiController extends Controller
{
    public function index()
    {
        $classification = new AgeClassification();

        $races = $classification->getRaces();

        return response()->json(new ClassificationResource($races), 200);
    }
}
