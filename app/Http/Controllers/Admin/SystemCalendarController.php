<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 

        foreach (\App\Congress::all() as $congress) { 
           $crudFieldValue = $congress->getOriginal('data_inizio'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $congress->descrizione; 
           $prefix         = ''; 
           $suffix         = ''; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.congresses.edit', $congress->id)
           ]; 
        } 


       return view('admin.calendar' , compact('events')); 
    }

}
