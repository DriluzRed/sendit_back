<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = ['name', 'username', 'email', 'phone', 'website', 'id'];

    public function addresses()
    {
        return $this->hasOne(Address::class);
    }

    public function companies()
    {
        return $this->hasOne(Company::class);
    }
}
