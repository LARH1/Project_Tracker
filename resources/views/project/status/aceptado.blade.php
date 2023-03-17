<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/project.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <title>Proyecto - Tracking</title>
</head>
<style>
    .step-disabled {
        color: gray !important;
    }
</style>

<body>
    <div class="container">
        <article class="card">
            <header class="card-header project-title"> Proyectos / Tracking </header>
            <div class="card-body">
                <article class="card">
                    <div class="card-body row">
                        <div class="col my-2"> <strong>Proyecto #:</strong> <br> {{$proyecto->clave}} </div>
                        <div class="col my-2"> <strong>Fecha estimada de entrega</strong> <br>{{$proyecto->fecha_entrega}} </div>
                        <div class="col my-2">
                            <strong>Estado:</strong> {{$estado[0]}}
                            <span style="font-size: 14px;" class="text-muted"><br>{{$estado[1]}}</span>
                        </div>
                    </div>
                </article>
                <div class="track">
                    <div class="step active">
                        <span class="icon">
                            <i class="fa fa-check"></i>
                        </span>
                        <span class="text">Aceptado</span>
                    </div>
                    <div class="step {{$proyecto->estado>=2?'active':'step-disabled'}}">
                        <span class="icon">
                            <i class="fa fa-spinner"></i>
                        </span>
                        <span class="text">Fase I en proceso</span>
                    </div>
                    <div class="step {{$proyecto->estado>=5?'active':'step-disabled'}}">
                        <span class="icon">
                            <i class="fa fa-download"></i>
                        </span>
                        <span class="text">Terminado</span>
                    </div>
                    <div class="step {{$proyecto->estado>=6?'active':'step-disabled'}}">
                        <span class="icon">
                            <i class="fa fa-spinner"></i>
                        </span>
                        <span class="text"> Fase II en proceso</span>
                    </div>
                    <div class="step {{$proyecto->estado>=10?'active':'step-disabled'}}">
                        <span class="icon">
                            <i class="fa fa-check"></i>
                        </span>
                        <span class="text"> Terminado</span>
                    </div>
                </div>
                <br>
                <br>
                <hr>
                <ul class="row">
                    <div class="col col-lg-8 bg-danger1 mx-auto bo">
                        <!-- Pago inicial pendeinte -->
                        @if($proyecto->estado==0)
                        <form action="{{url('project/inipay')}}" enctype="multipart/form-data" method="POST">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <p class="mt-4">Ingrese el comprobante del pago para su validación</p>
                            <input type="file" accept="image/png, image/gif, image/jpeg" name="image" id="image">
                            <input required type="hidden" name="p_id" id="p_id" value="{{$proyecto->id}}">
                            <br>
                            <br>
                            <div class="form-row">
                                <label class="form-control-label col-md-2">Cantidad</label>
                                <input required type="number" step="1" name="cantidad" class="form-control col-md-3" placeholder="0.00">
                                <span class="text-muted" style="font-size: 10px;margin: 10px;">Importe pagado</span>
                            </div>
                            <div class="container text-center">
                                <button class="btn btn-warning mr-0">Enviar</button>
                            </div>
                        </form>
                        @elseif ($proyecto->estado==1)
                        <div class="container text-center">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <br>
                            <i style="font-size: 5rem;" class="text-secondary far fa-clock"></i>
                            <p class="mt-4">El comprobante del pago se encuentra en revisión</p>
                            <p>Después de validar el comprobante, comenzará el desarrollo del proyecto</p>
                        </div>
                        @elseif ($proyecto->estado==2)
                        <div class="container text-center">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <br>
                            <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-4">El proyecto se encuentra en desarrollo</p>
                            <p>Te notificaremos cuando esté lista la primera etapa!</p>
                        </div>
                        @elseif ($proyecto->estado==3)
                        <form action="{{url('project/secondpay')}}" enctype="multipart/form-data" method="POST">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <p class="mt-4">Ingrese el comprobante del pago para su validación</p>
                            <input required type="file" accept="image/png, image/gif, image/jpeg" name="image" id="image">
                            <input required type="hidden" name="p_id" id="p_id" value="{{$proyecto->id}}">
                            <br>
                            <br>
                            <div class="form-row">
                                <label class="form-control-label col-md-2">Cantidad</label>
                                <input required type="number" step="1" name="cantidad" class="form-control col-md-3" placeholder="0.00">
                                <span class="text-muted" style="font-size: 10px;margin: 10px;">Importe pagado</span>
                            </div>
                            <div class="container text-center">
                                <button class="btn btn-warning mr-0">Enviar</button>
                            </div>
                        </form>
                        @elseif ($proyecto->estado==4)
                        <div class="container text-center">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <br>
                            <i style="font-size: 5rem;" class="text-secondary far fa-clock"></i>
                            <p class="mt-4">El comprobante del pago se encuentra en revisión</p>
                            <p>
                                Después de validar el comprobante, obtendrá el enlace del proyecto para comprobar su desarrollo
                            </p>
                        </div>
                        @elseif ($proyecto->estado==5)
                        <div class="container text-center">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <br>
                            <i style="font-size: 5rem;" class="text-secondary fas fa-download"></i>
                            <p class="mt-4">La fase I del proyecto se encuentra disponible para su descarga</p>
                            <a href="{{url('project/download/f1/'.$proyecto->clave)}}" class="btn btn-warning mr-0">
                                Descargar
                            </a>
                        </div>
                        @elseif ($proyecto->estado==6)
                        <div class="container text-center">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <br>
                            <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-4">El proyecto se encuentra en desarrollo</p>
                            <p>Te notificaremos cuando esté lista la segunda etapa!</p>
                        </div>
                        @elseif ($proyecto->estado==7)
                        <form action="{{url('project/finalpay')}}" enctype="multipart/form-data" method="POST">
                            <p class="h5"> {{$estado[0]}} - {{$estado[1]}}</p>
                            <p class="mt-4">Ingrese el comprobante del pago para su validación</p>
                            <input required type="file" accept="image/png, image/gif, image/jpeg" name="image" id="image">
                            <input type="hidden" name="p_id" id="p_id" value="{{$proyecto->id}}">
                            <br>
                            <br>
                            <div class="form-row">
                                <label class="form-control-label col-md-2">Cantidad</label>
                                <input required type="number" step="1" name="cantidad" class="form-control col-md-3" placeholder="0.00">
                                <span class="text-muted" style="font-size: 10px;margin: 10px;">Importe pagado</span>
                            </div>
                            <div class="container text-center">
                                <button class="btn btn-warning mr-0">Enviar</button>
                            </div>
                        </form>
                        @elseif ($proyecto->estado==8)
                        <div class="container text-center">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <br>
                            <i style="font-size: 5rem;" class="text-secondary far fa-clock"></i>
                            <p class="mt-4">El comprobante del pago se encuentra en revisión</p>
                            <p>
                                Después de validar el comprobante, obtendrá el enlace del proyecto para comprobar su desarrollo
                            </p>
                        </div>
                        @elseif ($proyecto->estado==9)
                        <div class="container text-center">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <br>
                            <i style="font-size: 5rem;" class="text-secondary fas fa-download"></i>
                            <p class="mt-4">Desarrollo finalizado. Se encuentra disponible para su descarga</p>
                            <a href="{{url('project/download/f2/'.$proyecto->clave)}}" class="btn btn-warning mr-0">
                                Descargar
                            </a>
                        </div>
                        @elseif ($proyecto->estado==10)
                        <div class="container text-center">
                            <p class="h5 ">{{$estado[1]}}</p>
                            <br>
                            <i style="font-size: 5rem;" class="text-secondary fas fa-check"></i>
                            <p class="mt-4">El proyecto ha finalizado todas sus etapas</p>
                        </div>
                        @else ($proyecto->estado==2)
                        <p>ERROR</p>
                        @endif
                    </div>
                </ul>
                <form action="/project/cambiar" method="post" class="text-right">
                    <input required type="hidden" name="p_id" id="p_id" value="{{$proyecto->id}}">
                    <input required type="hidden" name="estado" id="estado" value="{{$proyecto->estado}}">
                    <span class="text-muted">Solo para prueba</span>
                    <button class="btn btn-warning mr-0">Cambiar Estado</button>
                </form>
                <hr>
            </div>
        </article>
    </div>
</body>
<script>
    $("#btnDownload").click(function() {
        let id = $("#p_clid").val();
        window.open("project/download/f2/" + id, '_blank');
    });
</script>

</html>