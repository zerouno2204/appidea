<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Province
 *
 * @package App
 * @property string $nome
 * @property string $slug
*/
class Province extends Model
{
    protected $fillable = ['nome', 'slug'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Province::observe(new \App\Observers\UserActionsObserver);
    }
    
}
