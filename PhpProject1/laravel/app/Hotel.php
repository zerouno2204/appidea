<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hotel
 *
 * @package App
 * @property string $nome
 * @property string $lat
 * @property string $lng
 * @property string $indirizzo
 * @property string $cap
 * @property string $citta
 * @property string $provincia
 * @property text $descrizione
*/
class Hotel extends Model
{
    protected $fillable = ['nome', 'lat', 'lng', 'indirizzo', 'cap', 'descrizione', 'citta_id', 'provincia_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Hotel::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCittaIdAttribute($input)
    {
        $this->attributes['citta_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProvinciaIdAttribute($input)
    {
        $this->attributes['provincia_id'] = $input ? $input : null;
    }
    
    public function citta()
    {
        return $this->belongsTo(City::class, 'citta_id');
    }
    
    public function provincia()
    {
        return $this->belongsTo(Province::class, 'provincia_id');
    }
    
}
