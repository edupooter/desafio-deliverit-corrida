<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRunnerRequest;
use App\Http\Resources\Admin\RunnerResource;
use App\Models\Runner;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RunnersApiController extends Controller
{
    public function index()
    {
        return new RunnerResource(Runner::all());
    }

    public function store(StoreRunnerRequest $request)
    {
        $runner = Runner::create($request->all());

        return (new RunnerResource($runner))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
