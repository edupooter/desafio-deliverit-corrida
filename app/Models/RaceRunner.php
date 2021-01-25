<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class RaceRunner extends Model
{
    public $table = 'race_runners';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'runner_id',
        'race_id',
        'created_at',
        'updated_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function runner()
    {
        return $this->belongsTo(Runner::class, 'runner_id');
    }

    public function race()
    {
        return $this->belongsTo(Racing::class, 'race_id');
    }
}
