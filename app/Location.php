<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    public $table = 'locations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'location',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function workingHours()
    {
        return $this->hasMany(WorkingHour::class, 'workinghours_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'select_location_id', 'id');
    }
}
