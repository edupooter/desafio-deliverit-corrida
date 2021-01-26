<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Racing;
use Illuminate\Http\Request;
use App\Models\RunnersResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\GeneralClassification;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Admin\ClassificationResource;

class GeneralClassificationApiController extends Controller
{
    public function index()
    {
        $classification = new GeneralClassification();

        $races = $classification->getRaces();

        return response()->json(new ClassificationResource($races), 200);
    }
}
