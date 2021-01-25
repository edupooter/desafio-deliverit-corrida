<?php

namespace App\Http\Requests;

use App\Models\Runner;
use Gate;
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
            'name'     => [
                'string',
                'required',
            ],
            'cpf' => [
                // 'string',
                'required',
                'cpf',
            ],
            'birthday' => [
                'required',
                'date_format:' . 'd/m/Y',
                'before:-18 years',
            ],
        ];
    }
}
