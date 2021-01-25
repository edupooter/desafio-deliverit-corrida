<?php

Route::group([
    'prefix' => 'v1',
    'as' => 'api.',
    'namespace' => 'Api\V1\Admin',
], function () {
    Route::apiResource('runners', 'RunnersApiController', ['except' => ['show', 'update', 'destroy']]);

    Route::apiResource('runners-results', 'RunnersResultsApiController', ['except' => ['show', 'update', 'destroy']]);

    Route::apiResource('race-runners', 'RaceRunnersApiController', ['except' => ['show', 'update', 'destroy']]);

    Route::apiResource('racings', 'RacingApiController', ['except' => ['show', 'update', 'destroy']]);
});
