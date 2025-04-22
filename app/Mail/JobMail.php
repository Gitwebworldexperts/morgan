<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     */
    public function __construct($contact,$resume = null)
    {
        $this->contact = $contact;
        $this->resume = $resume;
    }

    /**
     * Build the message.
     */
    public function build()
    {
            $mail =  $this->from(config('mail.from.address'))
                    ->subject('New Application Submission')
                    ->view('emails.apply')
                    ->with('contact', $this->contact);
                    
                    // ->cc(['sahibjot@webworldexpertsindia.com', 'yesvant@webworldexpertsindia.com']);
                    
            if ($this->resume) {
                // Check if the file exists before attaching
                if (file_exists($this->resume)) {
                    $mail->attach($this->resume, [
                        'as' => basename($this->resume), // Retain the original file name
                        'mime' => mime_content_type($this->resume), // Get MIME type based on the actual file path
                    ]);
                } else {
                    
                    // Handle the case where the file doesn't exist (optional)
                    // For example, log an error or return a response
                    Log::error('Resume file does not exist: ' . $this->resume);
                }
            }


            return $mail;
    }
}
