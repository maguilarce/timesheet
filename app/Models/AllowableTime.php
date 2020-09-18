<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllowableTime extends Model
{
    protected $table = "allowable-time";

    protected $fillable = [
        'month',
        'date',
        'allowable_hours'

    ];
}
