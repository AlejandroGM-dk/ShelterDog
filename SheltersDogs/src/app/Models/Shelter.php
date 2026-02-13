<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    //
    protected $fillable = [
        'name',
        'city',
        'phone'
    ];

public function dogs(){return $this->hasMany(Dog::class);}






}


