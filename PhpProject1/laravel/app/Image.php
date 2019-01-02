<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * Class Image
 *
 * @package App
 * @property string $nome
*/
class Image extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['nome'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Image::observe(new \App\Observers\UserActionsObserver);
    }
    
}
