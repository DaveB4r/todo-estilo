<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Navegación -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-16 w-auto" src="/img/Logo_todo_estilo.png" alt="Logo">
                    </div>
                    <!-- Nombre del negocio -->
                    <div class="ml-9 flex items-center">
                        <h1 class="text-3xl italic font-serif text-gray-800">Todo Estilo</h1>
                    </div>
                </div>
                <!-- Menú de navegación -->
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Inicio sesión</a>
                    <a href="#servicios" class="text-gray-600 hover:text-gray-900 px-3 py-2">Servicios</a>
                    <a href="#quienes_somos" class="text-gray-600 hover:text-gray-900 px-3 py-2">¿Quiénes somos?</a>
                    <a href="#contactanos" class="text-gray-600 hover:text-gray-900 px-3 py-2">Contáctanos</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main>
        <div class="text-center py-3">
            <h1 class="text-5xl italic font-serif text-gray-800">Bienvenidos a Todo Estilo</h1>
        </div>
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
                    <!-- Slides -->
                    <div class="bg-gray-300 h-96 rounded-lg overflow-hidden relative">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="activeSlide === index" class="absolute inset-0 transition-opacity duration-700">
                                <img :src="slide" alt="" class="w-full h-full object-cover">
                            </div>
                        </template>


                        <!-- Controles -->
                        <div class="absolute inset-0 flex justify-between items-center px-4">
                            <button @click="prev" class="bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75">&larr;</button>
                            <button @click="next" class="bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75">&rarr;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de servicios -->
        <div id="servicios" class="bg-white">
            <div class="bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                    <h2 class="text-3xl italic font-serif text-gray-800 text-center mb-8">Nuestros servicios</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Tarjeta de servicio 1 -->
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold mb-4">Servicios de peluquería, tintes, quimicos y alisados</h3>

                            <p class="text-gray-600 mt-4">Servicios integrales que incluyen cortes modernos para todas las edades, peinados para todo tipo de eventos especiales, tintes profesionales coloración completa, mechas, balayage y retoques. También realizamos tratamientos químicos como alisados progresivos, keratina e hidrolizados. Además, contamos con tratamientos capilares para hidratar, fortalecer y revitalizar el cabello según sus necesidades.</p>
                            <div class="flex items-center space-x-4 mb-4 mt-4">
                                <p class="text-lg font-semibold m-0 p-0">Pide tu cita aquí</p>
                                <a href="https://wa.me/573128845647?text=Hola,%20quisiera%20pedir%20una%20cita%20para%20un%20servicio%20de%20peluquer%C3%ADa."
                                    target="_blank"
                                    class="inline-block bg-white hover:bg-gray-50 text-green-600 border border-green-500 font-bold py-2 px-4 rounded-full text-sm transition duration-300 ease-in-out shadow-sm">
                                    WhatsApp
                                </a>
                            </div>
                            <!-- Carrusel de imágenes servicio 1-->
                            <div class="relative overflow-hidden">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                                    <div class="bg-gray-300 h-96 md:h-[500px] rounded-lg overflow-hidden relative">
                                        <video class="absolute top-0 left-0 w-full h-full object-cover"
                                            src="{{ asset('videos/peluqueria1.mp4') }}"
                                            autoplay
                                            loop
                                            muted
                                            playsinline>
                                            Tu navegador no soporta el tag de video.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta de servicio 2 -->
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold mb-4">Maquillaje profesional</h3>
                            <p class="text-gray-600">Maquillaje profesional para todo tipo de eventos, desde bodas y fiestas hasta sesiones fotográficas, eventos nocturnos y temáticos. Nuestro equipo se enfoca en realzar tu belleza natural con productos de alta calidad y técnicas actualizadas, creando looks personalizados que se adaptan a tu estilo, tipo de evento y necesidades. Ya sea un maquillaje natural, glamuroso o artístico, garantizamos un acabado impecable y duradero</p>
                            <div class="flex items-center space-x-4 mb-4 mt-4">
                                <p class="text-lg font-semibold m-0 p-0">Pide tu cita aquí</p>
                                <a href="https://wa.me/573128845647?text=Hola,%20quisiera%20pedir%20una%20cita%20para%20un%20servicio%20de%20peluquer%C3%ADa."
                                    target="_blank"
                                    class="inline-block bg-white hover:bg-gray-50 text-green-600 border border-green-500 font-bold py-2 px-4 rounded-full text-sm transition duration-300 ease-in-out shadow-sm">
                                    WhatsApp
                                </a>
                            </div>
                            <!-- Carrusel de imágenes servicio 2-->
                            <div class="relative overflow-hidden">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                                    <div class="bg-gray-300 h-96 md:h-[500px] rounded-lg overflow-hidden relative">
                                        <video class="absolute top-0 left-0 w-full h-full object-cover"
                                            src="{{ asset('videos/uñas1.mp4') }}"
                                            autoplay
                                            loop
                                            muted
                                            playsinline>
                                            Tu navegador no soporta el tag de video.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta de servicio 3 -->
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            <h3 class="text-xl font-semibold mb-4">Manicura y pedicura</h3>
                            <p class="text-gray-600">Servicios de manicura y pedicura combinan estética, cuidado y bienestar para mantener tus uñas y piel en óptimas condiciones. Ofrecemos desde opciones básicas y semipermanentes hasta tratamientos spa, uñas esculpidas, decoración personalizada y pedicura clínica. Cada sesión incluye atención a cutículas, exfoliación, hidratación y masaje, brindándote no solo una imagen impecable, sino también una experiencia relajante y revitalizante</p>
                            <div class="flex items-center space-x-4 mb-4 mt-4">
                                <p class="text-lg font-semibold m-0 p-0">Pide tu cita aquí</p>
                                <a href="https://wa.me/573128845647?text=Hola,%20quisiera%20pedir%20una%20cita%20para%20un%20servicio%20de%20peluquer%C3%ADa."
                                    target="_blank"
                                    class="inline-block bg-white hover:bg-gray-50 text-green-600 border border-green-500 font-bold py-2 px-4 rounded-full text-sm transition duration-300 ease-in-out shadow-sm">
                                    WhatsApp
                                </a>
                            </div>
                            <!-- Carrusel de imágenes principal -->
                            <div class="relative overflow-hidden">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                                    <div class="bg-gray-300 h-96 md:h-[500px] rounded-lg overflow-hidden relative">
                                        <video class="absolute top-0 left-0 w-full h-full object-cover"
                                            src="{{ asset('videos/maquillaje1.mp4') }}"
                                            autoplay
                                            loop
                                            muted
                                            playsinline>
                                            Tu navegador no soporta el tag de video.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Quienes Somos -->
            <section id="quienes_somos" class="w-full bg-white py-12">
                <h2 class="text-3xl italic font-serif text-gray-800 text-center mb-8">¿Quiénes somos?</h2>
                <div class="flex flex-col md:flex-row items-center max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">


                    <!-- Imagen lado izquierdo -->
                    <div class="w-full md:w-1/2 h-80 md:h-[500px] relative overflow-hidden rounded-lg shadow-md">
                        <video class="absolute top-0 left-0 w-full h-full object-cover"
                            src="{{ asset('videos/presentacion1.mp4') }}" {{-- Cambiado a 'img' según tu ubicación --}}
                            autoplay
                            loop
                            muted
                            playsinline>
                            Tu navegador no soporta el tag de video.
                        </video>
                    </div>

                    <!-- Texto lado derecho -->
                    <div class="w-full md:w-1/2 mt-8 md:mt-0 md:pl-12 flex flex-col justify-start">
                        <h3 class="text-xl font-semibold mb-4">Un equipo profesional con experiencia y pasión por el cuidado personal</h3>
                        <p class="text-gray-600 text-justify">
                            En Todo Estilo contamos con un equipo multidisciplinario de profesionales altamente capacitados y apasionados por el arte del cuidado personal y la belleza.<br><br>
                            Nuestros estilistas y especialistas en tratamientos capilares combinan años de experiencia con formación continua para estar a la vanguardia de las últimas tendencias y técnicas. Cada miembro del equipo aporta una atención personalizada, escuchando y entendiendo las necesidades de nuestros clientes para ofrecer resultados que superen sus expectativas. En Todo Estilo, la calidad, el compromiso y el trato humano son nuestra esencia.
                        </p>
                    </div>

                </div>
            </section>


        </div>
        <section id="contactanos" class="w-full bg-gray-200 py-12">
            <h2 class="text-3xl italic font-serif text-gray-800 text-center mb-8">Contáctanos</h2>
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Nuestra Información</h3>
                    <ul class="space-y-3 text-gray-700">
                        <li>
                            <p class="font-medium">Facebook:</p>
                            <a href="https://www.facebook.com/people/Todo-Estilo-Peluquer%C3%ADa-y-Tienda-del-Peluquero/100046478302040/" target="_blank" class="text-blue-600 hover:underline">Todo Estilo - Peluquería y Tienda del Peluquero</a>
                        </li>
                        <li>
                            <p class="font-medium">Instagram:</p>
                            <a href="https://www.instagram.com/peluqueria_todo_estilo_/" target="_blank" class="text-pink-600 hover:underline">@peluqueria_todo_estilo_</a>
                        </li>
                        <li>
                            <p class="font-medium">Correo:</p>
                            <a href="mailto:todo_estilo@gmail.com" class="text-gray-700 hover:underline">todo_estilo@gmail.com</a>
                        </li>
                        <li>
                            <p class="font-medium">Whatsapp:</p>
                            <a href="https://wa.me/573184644398" target="_blank" class="text-green-600 hover:underline">3184644398</a>
                        </li>
                        <li>
                            <p class="font-medium">Dirección:</p>
                            <p>Cl. 36 #70 - 13 local 3, San Gabriel, Itagüí</p>
                        </li>
                    </ul>
                </div>

                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <h3 class="text-xl font-semibold p-6 pb-0 text-gray-800">Ubícanos</h3>
                    <div class="p-6">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1950000000003!2d-75.59765438523094!3d6.216298595460515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e442867d7d7d7d7%3A0x6e7e7e7e7e7e7e7e!2sCl.%2036%20%2370%20-%2013%20local%203%2C%20San%20Gabriel%2C%20Itag%C3%BC%C3%AD%2C%20Antioquia!5e0!3m2!1ses!2sco!4v1678901234567!5m2!1ses!2sco"
                            width="100%"
                            height="300"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Todo Estilo. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>

</html>