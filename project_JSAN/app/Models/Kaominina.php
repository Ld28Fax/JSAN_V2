<?php 
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    
    class Kaominina extends Model
    {

        protected $table = 'kaominina';
        public function distrika()
        {
            return $this->belongsTo(Distrika::class);
        }
    }
    