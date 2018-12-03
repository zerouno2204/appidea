<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * Class Hall
 *
 * @package App
 * @property string $nome
 * @property string $descrizione
 * @property string $capienza
 * @property string $id_giorno
*/
class Hall extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['nome', 'descrizione', 'capienza', 'id_giorno_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Hall::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdGiornoIdAttribute($input)
    {
        $this->attributes['id_giorno_id'] = $input ? $input : null;
    }
    
    public function id_giorno()
    {
        return $this->belongsTo(Day::class, 'id_giorno_id')->withTrashed();
    }
    
}
