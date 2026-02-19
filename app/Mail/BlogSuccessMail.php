<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $blog;

    public function __construct($user, $blog)
    {
        $this->user = $user;
        $this->blog = $blog;
    }

    public function build()
    {
        return $this->subject('Your blog has been successfully published!')
                    ->view('emails.blog_success'); // Blade view
    }
}
