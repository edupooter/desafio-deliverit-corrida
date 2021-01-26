<?php

namespace App\Http\Requests;

use App\Models\RaceRunner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StoreRaceRunnerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $runnerId = (int) $this->runner_id;
        $raceId = (int) $this->race_id;

        Validator::extend('runner_date_conflict', function ($attribute, $value) use ($runnerId, $raceId) {
            return $this->checkConflicts($runnerId, $raceId);
        });

        return [
            'runner_id' => [
                'required',
                'integer',
                'exists:runners,id',
                Rule::unique('race_runners')
                    ->where('runner_id', $this->request->get('runner_id'))
                    ->where('race_id', $this->request->get('race_id')),
                'runner_date_conflict'
            ],
            'race_id' => [
                'required',
                'integer',
                'exists:racings,id',
            ],
        ];
    }

    public function messages()
    {
        return [
            'runner_id.runner_date_conflict' => 'Esse corredor já participa de outra corrida na mesma data'
        ];
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

        return !$listaProvas;
    }
}
