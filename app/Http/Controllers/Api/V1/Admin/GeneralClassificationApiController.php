<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\RunnersResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Admin\ClassificationResource;

class GeneralClassificationApiController extends Controller
{
    public function index()
    {
        $classification = RunnersResult::with(['runner', 'race'])->get();

        return new ClassificationResource($classification);
    }
}
