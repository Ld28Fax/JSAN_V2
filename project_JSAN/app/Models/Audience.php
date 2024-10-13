<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    use HasFactory;

    protected $table = 'audience';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'heure',
        'magistrat',
        'greffier',
        'salle',
    ];

    public function demandeurs()
    {
    return $this->hasMany(Demandeur::class);
    }
}
