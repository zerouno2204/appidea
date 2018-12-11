<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Congress;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 

        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3 ){
            foreach (\App\Congress::all() as $congress) { 
           $crudFieldValue = $congress->getOriginal('data_inizio'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $congress->nome; 
           $prefix         = ''; 
           $suffix         = ''; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.congresses.edit', $congress->id)
           ]; 
        }
        }else{
            $user_id = Auth::user()->id;
            
            $congressi = Congress::whereIn('id', function($q) use ($user_id){
                $q->select('id_congress_id')
                        ->from('registrations')
                        ->where('id_user_id', $user_id);
            })->get();
            
            foreach ($congressi as $congress) { 
           $crudFieldValue = $congress->getOriginal('data_inizio'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $congress->nome; 
           $prefix         = ''; 
           $suffix         = ''; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.congresses.edit', $congress->id)
           ]; 
        }
        }
         


       return view('admin.calendar' , compact('events')); 
    }

}
