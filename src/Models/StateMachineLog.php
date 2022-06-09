<?php

namespace Chareice\LaravelEloquentFSM\Models;

use Illuminate\Database\Eloquent\Model;

class StateMachineLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'meta' => 'json'
    ];

    public function fsmable()
    {
        return $this->morphTo('fsmable');
    }
}
