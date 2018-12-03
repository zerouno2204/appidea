<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CongressEntry
 *
 * @package App
 * @property string $id_congress
 * @property string $id_entry
*/
class CongressEntry extends Model
{
    protected $fillable = ['id_congress_id', 'id_entry_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        CongressEntry::observe(new \App\Observers\UserActionsObserver);
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
    public function setIdEntryIdAttribute($input)
    {
        $this->attributes['id_entry_id'] = $input ? $input : null;
    }
    
    public function id_congress()
    {
        return $this->belongsTo(Congress::class, 'id_congress_id');
    }
    
    public function id_entry()
    {
        return $this->belongsTo(Entry::class, 'id_entry_id');
    }
    
}
