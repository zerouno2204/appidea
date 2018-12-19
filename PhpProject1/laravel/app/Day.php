<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Hall;

/**
 * Class Day
 *
 * @package App
 * @property string $nome
 * @property text $descrizione
 * @property string $id_congresso
 * @property string $data
*/
class Day extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'descrizione', 'data', 'id_congresso_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Day::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdCongressoIdAttribute($input)
    {
        $this->attributes['id_congresso_id'] = $input ? $input : null;
    }
    
    public function id_congresso()
    {
        return $this->belongsTo(Congress::class, 'id_congresso_id');
    }
    
    public function sala(){
        return $this->hasMany(Hall::class, 'id_giorno_id');
    }
    
}
