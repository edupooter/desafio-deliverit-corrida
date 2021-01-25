<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRaceRunnerRequest;
use App\Http\Resources\Admin\RaceRunnerResource;
use App\Models\RaceRunner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RaceRunnersApiController extends Controller
{
    public function index()
    {
        return new RaceRunnerResource(RaceRunner::with(['runner', 'race'])->get());
    }

    public function store(StoreRaceRunnerRequest $request)
    {
        $runnerId = (int) $request->input('runner_id');
        $raceId = (int) $request->input('race_id');

        $conflicts = $this->checkConflicts($runnerId, $raceId);

        if ($conflicts) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'runner_id' => 'Esse corredor já participa de outra corrida na mesma data'
                ]
            ], Response::HTTP_FORBIDDEN);
        }

        $raceRunner = RaceRunner::create($request->all());

        return (new RaceRunnerResource($raceRunner))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Verifica se há conflito entre corredor e prova
     * RN: Não é permitido cadastrar o mesmo corredor em duas provas diferentes na mesma data.
     * Por exemplo, o corredor Barry Allen não pode estar cadastrado nas provas de 21km e 42km no dia 05/10/2019.
     * @param integer $runnerId
     * @param integer $raceId
     * @return boolean
     */
    private function checkConflicts(int $runnerId, int $raceId): bool
    {
        $listaProvas = DB::select(
            'SELECT racings.id
            FROM race_runners
            INNER JOIN racings ON racings.id = race_runners.race_id
            WHERE (race_runners.runner_id = ? AND race_runners.race_id = ?)
            OR (race_runners.runner_id = ? AND racings.race_date IN
            (SELECT racings.race_date FROM racings WHERE racings.id = ?))',
            [$runnerId, $raceId, $runnerId, $raceId]
        );

        if ($listaProvas) {
            return true;
        }

        return false;
    }
}
