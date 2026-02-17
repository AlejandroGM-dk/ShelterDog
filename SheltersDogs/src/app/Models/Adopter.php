<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Adopter extends Model
{
    //
    use HasFactory;
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


