<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CongressHotel
 *
 * @package App
 * @property string $id_congress
 * @property string $id_hotel
*/
class CongressHotel extends Model
{
    protected $fillable = ['id_congress_id', 'id_hotel_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        CongressHotel::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdCongressIdAttribute($input)
    {
        $this->attributes['id_congress_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdHotelIdAttribute($input)
    {
        $this->attributes['id_hotel_id'] = $input ? $input : null;
    }
    
    public function id_congress()
    {
        return $this->belongsTo(Congress::class, 'id_congress_id');
    }
    
    public function id_hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel_id');
    }
    
}
