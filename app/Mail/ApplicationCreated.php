<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Application Created',
        );
    }


//    public function content()
//    {
//        return new Content(
//            view: 'view.name',
//        );
//    }


    public function attachments()
    {
        return [];
    }

    public function build()
    {
        $mail = $this->from('hello@example.com', 'example')
            ->subject('Application created')
            ->view('emails.application-created');

        if (! is_null($this->application->file_url))
        {
            $mail->attachFromStorageDisk('public', $this->application->file_url);
        }

        return $mail;
    }

}
