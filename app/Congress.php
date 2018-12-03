<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Congress
 *
 * @package App
 * @property string $nome
 * @property string $descrizione
 * @property string $data_inizio
 * @property string $data_fine
 * @property string $img
 * @property string $descr_sede
 * @property string $ind_sede
 * @property string $lat
 * @property string $lng
 * @property string $cap_sede
 * @property string $id_citta_sede
 * @property string $id_prov_sede
*/
class Congress extends Model
{
    protected $fillable = ['nome', 'descrizione', 'data_inizio', 'data_fine', 'img', 'descr_sede', 'ind_sede', 'lat', 'lng', 'cap_sede', 'id_citta_sede_id', 'id_prov_sede_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Congress::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDataInizioAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['data_inizio'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['data_inizio'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDataInizioAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDataFineAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['data_fine'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['data_fine'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDataFineAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdCittaSedeIdAttribute($input)
    {
        $this->attributes['id_citta_sede_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdProvSedeIdAttribute($input)
    {
        $this->attributes['id_prov_sede_id'] = $input ? $input : null;
    }
    
    public function id_citta_sede()
    {
        return $this->belongsTo(City::class, 'id_citta_sede_id');
    }
    
    public function id_prov_sede()
    {
        return $this->belongsTo(Province::class, 'id_prov_sede_id');
    }
    
}
