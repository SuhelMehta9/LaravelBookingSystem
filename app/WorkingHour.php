<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingHour extends Model
{
    use SoftDeletes;

    public $table = 'working_hours';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'endworkinghour',
        'workinghours_id',
        'startworkinghour',
    ];

    public function workinghours()
    {
        return $this->belongsTo(Location::class, 'workinghours_id');
    }
}
