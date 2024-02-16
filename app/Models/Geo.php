<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geo extends Model
{
    protected $fillable = ['address_id', 'lat', 'lng'];

    public function addresses()
    {
        return $this->belongsTo(Address::class);
    }
}
