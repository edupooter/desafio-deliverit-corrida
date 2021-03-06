<?php

namespace App\Http\Requests;

use App\Models\Runner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRunnerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'cpf' => [
                'string',
                'required',
                'cpf',
            ],
            'birthday' => [
                'required',
                'date_format:' . config('panel.date_format'),
                'before:-18 years',
            ],
        ];
    }
}
