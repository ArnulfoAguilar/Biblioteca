<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    
    @if ($motivo == 1)
        <title>Préstamo aprobado</title>   
    @elseif($motivo == 2)
        <title>Préstamo realizado</title>
    @elseif($motivo == 2)
        <title>Material devuelto</title>
    @endif
    
</head>
<body>

    @if ($motivo == 1)
        <p>¡Hola {{$user}}! Tu prestamo en biblioteca fue aprobado.</p>
        <p>Puedes ir a pedir el material solicitado a la biblioteca. También puedes seguir el proceso de tu préstamo en el sistema en línea</p>
        <br>
    @elseif($motivo == 2)
        <p>¡Hola {{$user}}! Has retirado el material solicitado.</p>
        <p>Esperamos quen le puedas sacar el máximo provecho al material que solicitaste. Recuerda delverlo a la biblioteca dentro del plazo que se te ha brindado</p>
        <p>También puedes seguir el proceso de tu préstamo y mas detalles en el sistema en línea</p>
        <br>
    @elseif($motivo == 3)
        <p>¡Hola {{$user}}! Has devuelto el material prestado.</p>
        <p>Gracias por devolver el material a la biblioteca. Esperamos que el material haya sido de mucha utilidad para ti</p>
        <br>
    @endif

    <p>Ingrese a la aplicacion desde:
        <a href="https://127.0.0.1:8000/">
            Sistema de Gestión Bibliotecaria 
        </a>
    </p>
    
</body>
</html>