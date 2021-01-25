<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRaceRunnerRequest;
use App\Http\Resources\Admin\RaceRunnerResource;
use App\Models\RaceRunner;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RaceRunnersApiController extends Controller
{
    public function index()
    {
        return new RaceRunnerResource(RaceRunner::with(['runner', 'race'])->get());
    }

    public function store(StoreRaceRunnerRequest $request)
    {
        $raceRunner = RaceRunner::create($request->all());

        return (new RaceRunnerResource($raceRunner))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
