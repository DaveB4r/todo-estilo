@extends('layouts.app')

@section('content')
    <main>
        <div class="text-center py-3">
            <h1 class="text-5xl italic font-serif text-gray-800">Bienvenidos a Todo Estilo</h1>
        </div>
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

        <div id="servicios" class="bg-white">
            <div class="bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                    <h2 class="text-3xl italic font-serif text-gray-800 text-center mb-8">Nuestros servicios</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold mb-4">Servicios de peluquería, tintes, quimicos y alisados</h3>
                            <p class="text-gray-600">Servicios integrales que incluyen cortes modernos para todas las edades, peinados para todo tipo de eventos especiales, tintes profesionales coloración completa, mechas, balayage y retoques. También realizamos tratamientos químicos como alisados progresivos, keratina e hidrolizados. Además, contamos con tratamientos capilares para hidratar, fortalecer y revitalizar el cabello según sus necesidades.</p>
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
                        </div>

                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold mb-4">Maquillaje profesional</h3>
                            <p class="text-gray-600">Maquillaje profesional para todo tipo de eventos, desde bodas y fiestas hasta sesiones fotográficas, eventos nocturnos y temáticos. Nuestro equipo se enfoca en realzar tu belleza natural con productos de alta calidad y técnicas actualizadas, creando looks personalizados que se adaptan a tu estilo, tipo de evento y necesidades. Ya sea un maquillaje natural, glamuroso o artístico, garantizamos un acabado impecable y duradero</p>
                            <div class="relative overflow-hidden">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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
                        </div>
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold mb-4">Manicura y pedicura</h3>
                            <p class="text-gray-600">Servicios de manicura y pedicura combinan estética, cuidado y bienestar para mantener tus uñas y piel en óptimas condiciones. Ofrecemos desde opciones básicas y semipermanentes hasta tratamientos spa, uñas esculpidas, decoración personalizada y pedicura clínica. Cada sesión incluye atención a cutículas, exfoliación, hidratación y masaje, brindándote no solo una imagen impecable, sino también una experiencia relajante y revitalizante</p>
                            <div class="relative overflow-hidden">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="quienes_somos" class="w-full bg-white py-12">
            <h2 class="text-3xl italic font-serif text-gray-800 text-center mb-8">¿Quiénes somos?</h2>
            <div class="flex flex-col md:flex-row items-center max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="w-full md:w-1/2 h-80 md:h-[500px]">
                    <img src="/img/Slider_2.jpg" alt="Quienes somos" class="w-full h-full object-cover rounded-lg shadow-md">
                </div>
                <div class="w-full md:w-1/2 mt-8 md:mt-0 md:pl-12 flex flex-col justify-start">
                    <h3 class="text-xl font-semibold mb-4">Un equipo profesional con experiencia y pasión por el cuidado personal</h3>
                    <p class="text-gray-600 text-justify">
                        En Todo Estilo contamos con un equipo multidisciplinario de profesionales altamente capacitados y apasionados por el arte del cuidado personal y la belleza.<br><br>
                        Nuestros estilistas y especialistas en tratamientos capilares combinan años de experiencia con formación continua para estar a la vanguardia de las últimas tendencias y técnicas. Cada miembro del equipo aporta una atención personalizada, escuchando y entendiendo las necesidades de nuestros clientes para ofrecer resultados que superen sus expectativas. En Todo Estilo, la calidad, el compromiso y el trato humano son nuestra esencia.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection