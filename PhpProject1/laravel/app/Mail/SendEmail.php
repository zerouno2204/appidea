<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Registration;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    protected $reg; 
    
    public function __construct(Registration $registration)
    {
        $this->reg = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $registration = $this->reg;
        
        $id = $registration->id;
        
        $images = \App\Image::whereIn('id', function ($q) use ($id){
            $q->select('id_image')
                    ->from('images_registration')
                    ->where('id_registrazione', $id);
        })->get();
        
        return $this->view('emails.email', compact('registration','images'));
    }
}
