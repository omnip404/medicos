<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    protected $fillable = ['nombre', 'especialidad', 'fnac', 'aniotituto', 'celular', 'foto'];
}
