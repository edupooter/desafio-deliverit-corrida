<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeneralClassification extends Model
{
    /**
     * Monta a lista de resultados de provas
     * e devolve a classificação geral
     * @return array
     */
    public function getRaces(): array
    {
        $races = array_merge(
            $this->getRacesByType('3'),
            $this->getRacesByType('5'),
            $this->getRacesByType('10'),
            $this->getRacesByType('21'),
            $this->getRacesByType('42')
        );

        return $races;
    }

    /**
     * Obtém a lista geral das provas por tipo
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
