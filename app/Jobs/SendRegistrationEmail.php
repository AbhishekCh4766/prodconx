<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Mail\Mailer;
use Mail;

class SendRegistrationEmail extends Job implements SelfHandling
{
	protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
         $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $data = [
            'title'  => 'Title',
            'intro'  => 'intro',
            'link'   => 'link',
            'confirmation_code' => 'confirmation_code'
        ];
        /*$mailer->send('emails.welcome',$data, function($message) {
            $message->to('naval.allalgos@gmail.com', 'naval.allalgos@gmail.com')
                    ->subject('Test mail');
        });*/
		
		 Mail::send('emails.welcome', $data, function ($m)  {
            $m->from('hello@app.com', 'Your Application');

            $m->to('naval.allalgos@gmail', 'naval.allalgos@gmail')->subject('Your Reminder!');
        });
		
    }
}
