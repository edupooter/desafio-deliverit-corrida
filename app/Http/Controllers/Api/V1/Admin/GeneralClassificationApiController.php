<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Racing;
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
        $races = array_merge(
            $this->getRacesByType('3'),
            $this->getRacesByType('5'),
            $this->getRacesByType('10'),
            $this->getRacesByType('21'),
            $this->getRacesByType('42')
        );

        return response()->json(new ClassificationResource($races), 200);
    }

    /**
     * Obtém a lista das provas por tipo
     * @param string $type Tipo de prova
     * @return array
     */
    private function getRacesByType(string $type): array
    {
        $races = DB::select(
            "SELECT
                rr.race_id AS raceId,
                race.`type` AS racetType,
                run.id AS runnerId,
                timestampdiff(
                    YEAR,
                    run.birthday,
                    now()
                ) AS runnerAge,
                run.name AS runnerName,
                TIMEDIFF(rr.finish_time, rr.start_time) AS duration
            FROM
                runners_results rr
            INNER JOIN racings race ON
                rr.race_id = race.id
            INNER JOIN runners run ON
                rr.runner_id = run.id
            WHERE
                race.`type` = ?
            ORDER BY
                duration ASC",
            [$type]
        );

        foreach ($races as $key => $race) {
            $race->runnerPosition = $key + 1;
        }

        return $races;
    }
}
