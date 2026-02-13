<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adopter extends Model
{
    //
    protected $fillable = [
    'name',
    'email',
    'phone'
    ];


    public function adoptions()
    {
    return $this->hasMany(Adoptions::class);
    }




 }


