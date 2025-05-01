@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1 class="display-4 mt-5 bg-white text-red-500" style="font-family: 'Playfair Display', serif;">Bienvenido a Todo Estilo</h1>
            <p class="lead">Tu destino de belleza y estilo</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Peluquería</h5>
                    <p class="card-text">Servicios profesionales de corte, color y peinado.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manicura y Pedicura</h5>
                    <p class="card-text">Cuidado completo para tus manos y pies.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Maquillaje Profesional</h5>
                    <p class="card-text">Realza tu belleza natural con nuestros servicios de maquillaje.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection