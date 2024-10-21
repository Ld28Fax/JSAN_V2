<?php 
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    
    class Kaominina extends Model
    {
        public function distrika()
        {
            return $this->belongsTo(Distrika::class);
        }
    }
    