<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConstPostulacionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Contancia de Postulación - UNHEVAL";
    public $proceso;
    public $datos_usuario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proceso,$datos_usuario)
    {
        $this->proceso = $proceso;
        $this->datos_usuario = $datos_usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.consPostulacion');
    }
}
