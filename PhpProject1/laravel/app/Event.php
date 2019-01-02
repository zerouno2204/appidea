<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 *
 * @package App
 * @property string $intervallo_orario
 * @property string $nome
 * @property text $descrizione
 * @property string $id_sala
*/
class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['intervallo_orario', 'nome', 'descrizione', 'id_sala_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Event::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdSalaIdAttribute($input)
    {
        $this->attributes['id_sala_id'] = $input ? $input : null;
    }
    
    public function id_sala()
    {
        return $this->belongsTo(Hall::class, 'id_sala_id')->withTrashed();
    }
    
}
