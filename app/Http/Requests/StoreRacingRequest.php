<?php

namespace App\Http\Requests;

use App\Models\Racing;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRacingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type'      => [
                'required',
            ],
            'race_date' => [
                'required',
                'date_format:' . 'd/m/Y',
            ],
        ];
    }
}
