<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Speaker
 *
 * @package App
 * @property string $nome
 * @property string $cognome
 * @property string $img_path
 * @property string $contatti
 * @property string $ruolo
 * @property text $descrizione
 * @property string $curriculuum
*/
class Speaker extends Model
{
    protected $fillable = ['nome', 'cognome', 'img_path', 'contatti', 'ruolo', 'descrizione', 'curriculuum'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Speaker::observe(new \App\Observers\UserActionsObserver);
    }
    
}
