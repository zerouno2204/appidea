<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Congress;
use App\Room;

class Congress_Rooms extends Model
{
    protected $table='room_congress';
    
     public function congress()
    {
        return $this->belongsTo(Congress::class, 'id_congress');
    }
    
    public function room()
    {
        return $this->belongsTo(Room::class, 'id_room');
    }
}
