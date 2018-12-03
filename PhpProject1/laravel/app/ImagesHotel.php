<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImagesHotel
 *
 * @package App
 * @property string $img
 * @property string $hotel
*/
class ImagesHotel extends Model
{
    protected $fillable = ['img_id', 'hotel_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ImagesHotel::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setImgIdAttribute($input)
    {
        $this->attributes['img_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setHotelIdAttribute($input)
    {
        $this->attributes['hotel_id'] = $input ? $input : null;
    }
    
    public function img()
    {
        return $this->belongsTo(Image::class, 'img_id');
    }
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    
}
