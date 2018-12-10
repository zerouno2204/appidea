<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SpeakersCongress
 *
 * @package App
 * @property string $id_congress
 * @property string $id_speaker
*/
class SpeakersCongress extends Model
{
    protected $fillable = ['id_congress_id', 'id_speaker_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        SpeakersCongress::observe(new \App\Observers\UserActionsObserver);
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
    
    public function id_congress()
    {
        return $this->belongsTo(Congress::class, 'id_congress_id');
    }
    
    public function id_speaker()
    {
        return $this->belongsTo(Speaker::class, 'id_speaker_id');
    }
    
}
