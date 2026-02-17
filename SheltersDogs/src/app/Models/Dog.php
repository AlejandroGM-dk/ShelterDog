<?php

namespace App\Models;
use App\Models\Adoptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Dog extends Model
{
    //
    use HasFactory;
        protected $fillable = [
        'name',
        'breed',
        'age',
        'shelter_id',
        'status'
    ];


    public function shelter()
    {return $this->belongsTo(Shelter::class);}

    public function adoption()
    {return $this->hasOne(Adoptions::class, 'dog_id');}




}
