<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoptions extends Model
{
    //
    protected $fillable = [
        'dog_id',
        'adopter_id',
        'adoption_date'
    ];

    public function adopter(){return $this->belongsTo(Adopter::class);}

    public function dog(){return $this->belongsTo(Dog::class);}



}
