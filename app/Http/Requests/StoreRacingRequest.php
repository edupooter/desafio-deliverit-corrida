<?php

namespace App\Http\Requests;

use App\Models\Racing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreRacingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
                Rule::in(['3', '5', '10', '21', '42']),
            ],
            'race_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
