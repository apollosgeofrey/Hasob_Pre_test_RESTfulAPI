<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue; 
use App\Mail\UserRegisterMail;
use App\Events\UserEvent;
use App\Notifications\UserNotification;

class UserRegisterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserEvent $data)
    {        
        // i can proceding sending email if neccessary
        //Mail::to($data->email)->send(new UserRegisterMail());
          /*if (Mail::failures()) {
               return response()->Fail('Sorry! Please try again latter');
          }else{
               return response()->success('Great! Successfully send in your mail');
             }*/

             //can send
//             $data->notify(new InvoicePaid());
    }
}
