<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class AnggotaDitolakMail extends Mailable
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
        return $this->subject('Informasi Hasil Seleksi UKM')
                    ->view('emails.anggota_ditolak');
    }
}