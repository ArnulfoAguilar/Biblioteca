<?php

namespace App\Console\Commands;

use App\Mail\SendprestamoVencido;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PrestamoVencido extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prestamo:vencido';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo a todos los usuarios que se les vencio el tiempo de entrega del material bibliotecario prestado';

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
        $UsuariosMorosos = \DB::table('Prestamo')
        ->select('ID_USUARIO')
        ->whereRaw('Date(FECHA_DEVOLUCION) < CURDATE()');
        Mail::to('arnulfo.aguilar9405@gmail.com')->send(new SendprestamoVencido());
    }
}
