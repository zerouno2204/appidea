<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Entry
 *
 * @package App
 * @property string $nome
 * @property string $data_inizio
 * @property string $data_fine
 * @property string $prezzo
 * @property string $ab_codice
 * @property text $descrizione
*/
class Entry extends Model
{
    protected $fillable = ['nome', 'data_inizio', 'data_fine', 'prezzo', 'ab_codice', 'descrizione'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Entry::observe(new \App\Observers\UserActionsObserver);
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
    
}
