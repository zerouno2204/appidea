<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentType
 *
 * @package App
 * @property string $nome
 * @property string $slug
*/
class DocumentType extends Model
{
    protected $fillable = ['nome', 'slug'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        DocumentType::observe(new \App\Observers\UserActionsObserver);
    }
    
}
