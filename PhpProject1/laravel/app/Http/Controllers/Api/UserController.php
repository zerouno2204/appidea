<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Congress;
use Carbon\Carbon;
use Validator;

class UserController extends Controller
{
    
    public $successStatus = 200;
    
    public function login(){
        if(Auth::attempt(['email'=> request('email'), 'password'=> request('password')])){
            $user = Auth::user();
            $success['token'] = $user->createToken('AppIdea')->accessToken;
            
            return response()->json(['success' => $success], $this->successStatus);
        }else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    
    public function register(\Zend\Diactoros\Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }else{
            User::create($request->all());
        }       
        
    }
    
    public function calendar(){
        
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
        
        
         return response()->json(['events'=>$events], $this->successStatus);
    }
    
    
}
