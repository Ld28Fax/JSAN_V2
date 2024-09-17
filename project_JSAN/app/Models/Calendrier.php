<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendrier extends Model
{
    use HasFactory;

    protected $table = ['Calendrier'];

    protected $fillable = ['titre', 'debut_periode', 'fin_periode'];
}
