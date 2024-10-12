<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Demandeur extends Model
{
    use HasFactory;


    protected $table= 'demandeur';

    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [ 'Nom','Date_de_Naissance', 'Lieu_de_Naissance','Pere', 'Mere', 'Adresse', 'Telephone','etat', 'usertpi', 'interesse', 'kaominina', 'distrika', 'genre'];

    public static function modifier($id ,$Nom,$Date_de_Naissance, $Lieu_de_Naissance,$Pere, $Mere, $Adresse, $Telephone)
    {
        try{
            $update = DB::table('demandeur')->where('id','=',$id)
            ->update([
                'id'=> $id,
                'Nom'=> $Nom,
                'Date_de_Naissance'=> $Date_de_Naissance,
                'Lieu_de_Naissance'=> $Lieu_de_Naissance,
                'Pere'=> $Pere,
                'Mere'=> $Mere,
                'Adresse'=> $Adresse,
                'Telephone'=> $Telephone,
                // 'interesse'=> $interesse,
                // 'kaominina' => $kaominina,
                // 'distrika' => $distrika

            ]);
            return $update;
            
        }catch (Exception $e ){
            throw new Exception($e->getMessage());
        }
    }

    public static function Activer ($id) {
        try{
            $active = DB::table('demandeur')->where('id','=',$id)->update(['etat' => 1]);
            return $active;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public static function desactiver ($id) {
        try{
            $desactive = DB::table('demandeur')->where('id','=',$id)->update(['etat' => 2]);
            return $desactive;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }    

}
