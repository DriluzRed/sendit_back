<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['person_id', 'street', 'suite', 'city', 'zipcode'];

    public function persons()
    {
        return $this->belongsTo(Person::class);
    }

    public function geos()
    {
        return $this->hasOne(Geo::class);
    }
}
