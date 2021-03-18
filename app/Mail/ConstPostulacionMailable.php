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
    public $datos_postulante;
    public $postulacion;
    public $desc_u_nac;
    public $desc_u_dom;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proceso,$datos_postulante,$postulacion, $desc_u_nac, $desc_u_dom)
    {
        $this->proceso = $proceso;
        $this->datos_postulante = $datos_postulante;
        $this->postulacion = $postulacion;
        $this->desc_u_nac = $desc_u_nac;
        $this->desc_u_dom = $desc_u_dom;
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
