<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $motivo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $motivo)
    {
        //
        $this->user = $user;
        $this->motivo = $motivo;
    }

    //MOTIVOS
    // 1=Prestamo aprobado
    // 2=Material prestado
    // 3=Prestamo finalizado

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mails.notificaciones');
    }
}
