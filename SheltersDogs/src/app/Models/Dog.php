<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Dog extends Model
{
    //
        protected $fillable = [
        'name',
        'breed',
        'age',
        'shelter_id',
        'status'
    ];


    public function shelter()
    {return $this->belongsTo(Shelter::class);}

    public function adoptions()
    {return $this->hasMany(Adoptions::class);}




}
