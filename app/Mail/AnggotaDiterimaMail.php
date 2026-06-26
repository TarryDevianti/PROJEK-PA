<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnggotaDiterimaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $ukm;
    public $pendaftaran;

    public function __construct($user, $ukm, $pendaftaran)
    {
        $this->user = $user;
        $this->ukm = $ukm;
        $this->pendaftaran = $pendaftaran;
    }

    public function build()
    {
        return $this->subject('Selamat! Pendaftaran Anda Diterima')
                    ->view('emails.anggota_diterima');
    }
}