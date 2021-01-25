<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRunnersResultRequest;
use App\Http\Resources\Admin\RunnersResultResource;
use App\Models\RunnersResult;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RunnersResultsApiController extends Controller
{
    public function index()
    {
        return new RunnersResultResource(RunnersResult::with(['runner', 'race'])->get());
    }

    public function store(StoreRunnersResultRequest $request)
    {
        $runnersResult = RunnersResult::create($request->all());

        return (new RunnersResultResource($runnersResult))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
