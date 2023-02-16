<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoValidadorMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Se te asignó un nuevo documento para validarlo';

    public $revision;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($revision)
    {
        $this->revision = $revision;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.validarEmail', ['id'=> $this->revision]);
    }
}
