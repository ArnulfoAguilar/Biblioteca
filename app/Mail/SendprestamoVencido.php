<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendprestamoVencido extends Mailable
{
    use Queueable, SerializesModels;
    
    public $EjemplarPrestado;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($EjemplarPrestado)
    {
        $this->EjemplarPrestado = $EjemplarPrestado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mails.prestamoVencido')
        ->with([
            'Ejemplar' => $this->EjemplarPrestado,
        ]);
    }
}
