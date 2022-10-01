<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Session extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sessions';

    protected $fillable = [
        'category_id',
        'session_name',
        'start_time',
        'end_time'
    ];

    protected $appends = [
        'start_time_label',
        'end_time_label'
    ];

    public function startTimeLabel(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Carbon::parse($attributes['start_time'])->format('H:i d/m/Y');
            },
        );
    }

    public function endTimeLabel(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Carbon::parse($attributes['end_time'])->format('H:i d/m/Y');
            },
        );
    }
}
