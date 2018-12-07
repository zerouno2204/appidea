<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * Class Registration
 *
 * @package App
 * @property string $nome_documento
 * @property string $luogo_rilascio
 * @property string $data_emissione
 * @property string $data_scadenza
 * @property integer $id_tipo_doc
 * @property string $path_img_doc
 * @property string $note
 * @property string $registrationscol
 * @property string $id_entry
 * @property string $id_congress
 * @property string $id_speaker
 * @property string $id_hotel
 * @property string $id_user
 * @property string $id_camera
*/
class Registration extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = ['nome_documento', 'luogo_rilascio', 'data_emissione', 'data_scadenza', 'note', 'codice', 'id_entry_id', 'id_congress_id', 'id_speaker_id', 'id_hotel_id', 'id_user_id', 'id_camera_id', 'id_tipo_doc', 'path_img_doc'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Registration::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDataEmissioneAttribute($input)
    {
        if ($input != null && $input != '') 
            {
            $this->attributes['data_emissione'] = Carbon::createFromFormat(config('app.date_format'), $input)->toDateString();
        } 
        else {
            $this->attributes['data_emissione'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDataEmissioneAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) 
            {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } 
        else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDataScadenzaAttribute($input)
    {
        if ($input != null && $input != '') 
            {
            $this->attributes['data_scadenza'] = Carbon::createFromFormat(config('app.date_format'), $input)->toDateString();
        } 
        else {
            $this->attributes['data_scadenza'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDataScadenzaAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) 
            {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } 
        else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setIdTipoDocAttribute($input)
    {
        $this->attributes['id_tipo_doc'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdEntryIdAttribute($input)
    {
        $this->attributes['id_entry_id'] = $input ? $input : null;
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
    public function setIdSpeakerIdAttribute($input)
    {
        $this->attributes['id_speaker_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdHotelIdAttribute($input)
    {
        $this->attributes['id_hotel_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdUserIdAttribute($input)
    {
        $this->attributes['id_user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdCameraIdAttribute($input)
    {
        $this->attributes['id_camera_id'] = $input ? $input : null;
    }
    
    public function id_entry()
    {
        return $this->belongsTo(Entry::class, 'id_entry_id');
    }
    
    public function id_congress()
    {
        return $this->belongsTo(Congress::class, 'id_congress_id');
    }
    
    public function id_speaker()
    {
        return $this->belongsTo(Speaker::class, 'id_speaker_id');
    }
    
    public function id_hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel_id');
    }
    
    public function id_user()
    {
        return $this->belongsTo(User::class, 'id_user_id');
    }
    
    public function id_camera()
    {
        return $this->belongsTo(Room::class, 'id_camera_id');
    }
    
}
