<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Models\RunnersResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Admin\ClassificationResource;

class AgeClassificationApiController extends Controller
{
    public function index()
    {
        $races = array_merge(
            $this->getResultsByTypeAndAge('3', 18, 25),
            $this->getResultsByTypeAndAge('3', 26, 35),
            $this->getResultsByTypeAndAge('3', 36, 45),
            $this->getResultsByTypeAndAge('3', 46, 55),
            $this->getResultsByTypeAndAge('3', 56, 200),
            $this->getResultsByTypeAndAge('5', 18, 25),
            $this->getResultsByTypeAndAge('5', 26, 35),
            $this->getResultsByTypeAndAge('5', 36, 45),
            $this->getResultsByTypeAndAge('5', 46, 55),
            $this->getResultsByTypeAndAge('5', 56, 200),
            $this->getResultsByTypeAndAge('10', 18, 25),
            $this->getResultsByTypeAndAge('10', 26, 35),
            $this->getResultsByTypeAndAge('10', 36, 45),
            $this->getResultsByTypeAndAge('10', 46, 55),
            $this->getResultsByTypeAndAge('10', 56, 200),
            $this->getResultsByTypeAndAge('21', 18, 25),
            $this->getResultsByTypeAndAge('21', 26, 35),
            $this->getResultsByTypeAndAge('21', 36, 45),
            $this->getResultsByTypeAndAge('21', 46, 55),
            $this->getResultsByTypeAndAge('21', 56, 200),
            $this->getResultsByTypeAndAge('42', 18, 25),
            $this->getResultsByTypeAndAge('42', 26, 35),
            $this->getResultsByTypeAndAge('42', 36, 45),
            $this->getResultsByTypeAndAge('42', 46, 55),
            $this->getResultsByTypeAndAge('42', 56, 200)
        );

        return response()->json(new ClassificationResource($races), 200);
    }

    /**
     * Obtém a lista das provas por tipo e idade
     * @param string $type Tipo de prova
     * @param integer $minAge Limite mínimo do grupo etário
     * @param integer $maxAge Limite máximo do grupo etário
     * @return array
     */
    private function getResultsByTypeAndAge(string $type, int $minAge, int $maxAge): array
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
                TIMEDIFF(rr.finish_time, rr.start_time) AS duration,
                CASE
                    WHEN timestampdiff(YEAR, run.birthday, now()) BETWEEN 18 AND 25 THEN '18-25 anos'
                    WHEN timestampdiff(YEAR, run.birthday, now()) BETWEEN 26 AND 35 THEN '25-35 anos'
                    WHEN timestampdiff(YEAR, run.birthday, now()) BETWEEN 36 AND 45 THEN '35-45 anos'
                    WHEN timestampdiff(YEAR, run.birthday, now()) BETWEEN 46 AND 55 THEN '45-55 anos'
                    ELSE 'Acima de 55 anos'
                END AS ageGroup
            FROM
                runners_results rr
            INNER JOIN racings race ON
                rr.race_id = race.id
            INNER JOIN runners run ON
                rr.runner_id = run.id
            WHERE
                race.`type` = ?
                AND timestampdiff(YEAR, run.birthday, now()) BETWEEN ? AND ?
            ORDER BY
                ageGroup ASC,
                duration ASC",
            [$type, $minAge, $maxAge]
        );

        foreach ($races as $key => $race) {
            $race->runnerPosition = $key + 1;
        }

        return $races;
    }
}
