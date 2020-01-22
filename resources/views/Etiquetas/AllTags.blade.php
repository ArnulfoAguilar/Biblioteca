


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Imprimir</title>
     
     <script src="{{ asset('js/app.js') }}" defer></script>
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

     <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        </head>
<body>
    <div id="app">     
        <main class="py-4">
                <div class="row">
                        @foreach($tags as $tag)
                                <div class="col-lg-3 justify-content-center">
                                    <div class="card text-center">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <p style="max-height: 23px; overflow:hidden">
                                                    {{ $tag->EJEMPLAR }}
                                                </p>
                                                <p> {!! DNS1D::getBarcodeHTML($tag->CODIGO_BARRA, "C128") !!} </p>
                                                <p> {{ $tag->CODIGO_BARRA }} </p>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                        @endforeach
                </div>
                
        </main>
    </div>

</body>
</html>