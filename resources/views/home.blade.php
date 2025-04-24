@extends('layouts.app')

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body px-6">
          @if (Route::has('login'))
          <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endif
            @endauth
          </div>
          @endif

          <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./img/Slider_2.jpg" class="d-block w-100" alt="..." />
              </div>
              <div class="carousel-item">
                <img src="./img/Slider_3.jpg" class="d-block w-100" alt="..." />
              </div>
              <div class="carousel-item">
                <img src="./img/Slider_4.jpg" class="d-block w-100" alt="..." />
              </div>
            </div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselExample"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselExample"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <section id="inicio" class="mb-4">
            <h1 class="text-center mb-3 section-title h1">
              Bienvenidos a Todo Estilo
            </h1>

            <div class="card">
              <div class="card-body">
                <p class="text-red-500">
                  Este es un ejemplo de contenido principal de la página.
                </p>
              </div>
            </div>
          </section>

          <section id="servicios" class="mb-4">
            <h2 class="text-center mb-3 section-title">Nuestros Servicios</h2>
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Servicio 1</h5>
                    <p class="card-text">Descripción del servicio 1</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Servicio 2</h5>
                    <p class="card-text">Descripción del servicio 2</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Servicio 3</h5>
                    <p class="card-text">Descripción del servicio 3</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection