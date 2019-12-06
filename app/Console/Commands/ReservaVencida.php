<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;
use App\Modelos\Prestamo;
use App\User;


class ReservaVencida extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reserva:vencida';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia correo de que la reserva venció y ademas marca el prestamo como cancelado';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $prestamos = Prestamo::where('ID_ESTADO_PRESTAMO', 2)->get();
        $fecha_actual = date("Y-m-d");

        foreach ($prestamos as $key => $prestamo) {           
            $new_updated = date("Y-m-d",strtotime($prestamo->updated_at."+ 2 days"));
            if($fecha_actual >= $new_updated ){

                $prestamo->ID_ESTADO_PRESTAMO = 8;
                $prestamo->save();
            
                foreach ($prestamo->materiales as $key => $material) {
                    $material->DISPONIBLE = true;
                    $material->save();
                }

                $user = User::find( $prestamo->ID_USUARIO );
                Mail::to($user->email)->send(new Notificacion($user->name, 4));
            }
        }

    }
}
