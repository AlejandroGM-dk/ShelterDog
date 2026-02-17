<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Adoptions extends Model
{

use HasFactory;
    //
    protected $fillable = [
        'dog_id',
        'adopter_id',
        'adoption_date',
        'fee_paid'
    ];

    public function adopter(){return $this->belongsTo(Adopter::class, 'adopter_id');}

    public function dog(){return $this->belongsTo(Dog::class, 'dog_id');}



}
