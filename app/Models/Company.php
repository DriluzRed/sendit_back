<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['person_id', 'name', 'catchPhrase', 'bs'];

    public function persons()
    {
        return $this->belongsTo(Person::class);
    }
}
