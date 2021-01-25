<?php

namespace App\Http\Requests;

use App\Models\RaceRunner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreRaceRunnerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'runner_id' => [
                'required',
                'integer',
                'exists:runners,id',
                Rule::unique('race_runners')
                    ->where('runner_id', $this->request->get('runner_id'))
                    ->where('race_id', $this->request->get('race_id'))
            ],
            'race_id' => [
                'required',
                'integer',
                'exists:racings,id',
            ],
        ];
    }
}
