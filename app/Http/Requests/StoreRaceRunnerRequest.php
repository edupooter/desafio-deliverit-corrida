<?php

namespace App\Http\Requests;

use App\Models\RaceRunner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
            ],
            'race_id'   => [
                'required',
                'integer',
                'exists:racings,id',
            ],
        ];
    }
}
