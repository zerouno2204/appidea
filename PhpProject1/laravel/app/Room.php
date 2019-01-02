<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Room
 *
 * @package App
 * @property string $descrizione
 * @property string $prezzo
 * @property integer $p_letto
 * @property string $id_hotel
*/
class Room extends Model
{
    protected $fillable = ['descrizione', 'prezzo', 'p_letto', 'id_hotel_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Room::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPLettoAttribute($input)
    {
        $this->attributes['p_letto'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdHotelIdAttribute($input)
    {
        $this->attributes['id_hotel_id'] = $input ? $input : null;
    }
    
    public function id_hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel_id');
    }
    
}
