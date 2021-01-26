<?php

namespace App\Http\Requests;

use App\Models\RunnersResult;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreRunnersResultRequest extends FormRequest
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
                Rule::unique('runners_results')
                    ->where('runner_id', $this->runner_id)
                    ->where('race_id', $this->race_id)
            ],
            'race_id' => [
                'required',
                'integer',
                'exists:racings,id',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'finish_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
                'after:start_time',
            ],
        ];
    }
}
