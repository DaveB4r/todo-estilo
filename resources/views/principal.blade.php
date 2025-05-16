@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <!-- Carrusel de imágenes principal -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-data="{
                activeSlide: 0,
                slides: [
                    '/img/Slider_2.jpg',
                    '/img/Slider_3.jpg',
                    '/img/Slider_4.jpg'
                ],
                next() {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                },
                prev() {
                    this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
                }
            }" class="relative">
                <div class="bg-gray-300 h-96 rounded-lg overflow-hidden relative">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="activeSlide === index" class="absolute inset-0 transition-opacity duration-700">
                            <img :src="slide" alt="" class="w-full h-full object-cover">
                        </div>
                    </template>
                    <div class="absolute inset-0 flex justify-between items-center px-4">
                        <button @click="prev" class="bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75">&larr;</button>
                        <button @click="next" class="bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75">&rarr;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de servicios -->
    <div class="mt-12">
        <h2 class="text-3xl font-bold text-center mb-8">Nuestros Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Peluquería</h3>
                <p class="text-gray-600">Servicios profesionales de corte, color y peinado.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Manicura y Pedicura</h3>
                <p class="text-gray-600">Cuidado completo para tus manos y pies.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Maquillaje Profesional</h3>
                <p class="text-gray-600">Realza tu belleza natural con nuestros servicios de maquillaje.</p>
            </div>
        </div>
    </div>
</div>
@endsection