<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 *
 * @package App
 * @property string $name
 * @property string $province
*/
class City extends Model
{
    protected $fillable = ['name', 'province_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        City::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProvinceIdAttribute($input)
    {
        $this->attributes['province_id'] = $input ? $input : null;
    }
    
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
    
}
