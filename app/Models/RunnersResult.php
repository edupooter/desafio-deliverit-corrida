<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class RunnersResult extends Model
{
    public $table = 'runners_results';

    protected $fillable = [
        'runner_id',
        'race_id',
        'start_time',
        'finish_time',
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
