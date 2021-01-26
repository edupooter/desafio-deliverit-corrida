<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Racing extends Model
{
    public $table = 'racings';

    protected $dates = [
        'race_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'type',
        'race_date',
        'created_at',
        'updated_at',
    ];

    const TYPE_SELECT = [
        '3',
        '5',
        '10',
        '21',
        '42',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getRaceDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setRaceDateAttribute($value)
    {
        $this->attributes['race_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
