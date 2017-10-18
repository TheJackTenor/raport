<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

class SiswaKonfirmasi extends Mailable
{
    use Queueable, SerializesModels;

    public $isi;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isi)
    {
        $this->isi = $isi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dhihanlaksana@yahoo.com')->subject('Password Reset')->view('email/resetpassword');
    }
}
