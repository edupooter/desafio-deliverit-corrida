<?php

namespace App\Http\Requests;

use App\Models\RunnersResult;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRunnersResultRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'runner_id'   => [
                'required',
                'integer',
                'exists:runners,id',
            ],
            'race_id'     => [
                'required',
                'integer',
                'exists:racings,id',
            ],
            'start_time'  => [
                'required',
                'date_format:' . 'H:i:s',
            ],
            'finish_time' => [
                'required',
                'date_format:' . 'H:i:s',
            ],
        ];
    }
}
