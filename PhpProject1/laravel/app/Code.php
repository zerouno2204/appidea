<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Code
 *
 * @package App
 * @property string $code
 * @property string $qrcode
 * @property string $id_congress
 * @property string $id_user
*/
class Code extends Model
{
    protected $fillable = ['code', 'qrcode', 'id_congress_id', 'id_user_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Code::observe(new \App\Observers\UserActionsObserver);
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
    public function setIdUserIdAttribute($input)
    {
        $this->attributes['id_user_id'] = $input ? $input : null;
    }
    
    public function id_congress()
    {
        return $this->belongsTo(Congress::class, 'id_congress_id');
    }
    
    public function id_user()
    {
        return $this->belongsTo(User::class, 'id_user_id');
    }
    
}
