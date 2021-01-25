<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRacingRequest;
use App\Http\Resources\Admin\RacingResource;
use App\Models\Racing;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RacingApiController extends Controller
{
    public function index()
    {
        return new RacingResource(Racing::all());
    }

    public function store(StoreRacingRequest $request)
    {
        $racing = Racing::create($request->all());

        return (new RacingResource($racing))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
