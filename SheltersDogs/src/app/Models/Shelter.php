<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Shelter extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'city',
        'phone'
    ];

public function dogs(){return $this->hasMany(Dog::class);}






}


