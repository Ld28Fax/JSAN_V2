<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    
    class Distrika extends Model
    {
        public function kaominina()
        {
            return $this->hasMany(Kaominina::class);
        }
    }
    