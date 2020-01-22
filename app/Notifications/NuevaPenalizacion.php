<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Penalizacion;
use App\User;

class NuevaPenalizacion extends Notification
{
    use Queueable;

    //nuevo
    protected $penalizacion;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($penalizacion)
    {
        //
        $this->penalizacion = $penalizacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'penalizacion' => $this->penalizacion,
            //Comentado ya que no hace los Joins debido a que no tiene acceso al modelo sino a un arreglo 
            //sin relaciones
            
            // 'user' => User::find($this->penalizacion->prestamo->usuario->id)
        ];
    }
    
     public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
