<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indicadores - Todo Estilo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <img class="h-14 w-auto" src="/img/Logo_todo_estilo.png" alt="Logo">
                        </div>
                        <div class="ml-4 flex items-center">
                            <h1 class="text-3xl italic font-serif text-gray-800">Todo Estilo</h1>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900 px-3 py-2">
                                Cerrar sesión
                            </button>
                        </form>
                        @endauth
                        <a href="{{ route('cuentas_por_cobrar.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Regresar</a>                    </div>
                </div>
            </div>
        </nav>

        <div class="flex min-h-screen bg-gray-100">
            {{-- Aside / Sidebar --}}
            <aside class="w-64 bg-gray-500 shadow-md px-4 py-6 space-y-4 text-white">


                {{-- FORMULARIO DE FILTRO MOVIDO AQUÍ --}}
                <div class="mt-8 bg-gray-600 rounded-lg p-4 text-white"> {{-- Fondo más oscuro para contraste --}}
                    <h2 class="text-lg font-semibold mb-3">Filtrar</h2>
                    <form action="{{ route('indicadores.index') }}" method="GET" class="space-y-3"> {{-- Usamos space-y-3 para el espaciado vertical --}}
                        <div>
                            <label for="mes" class="block text-sm font-medium mb-1">Mes:</label>
                            <select name="mes" id="mes" class="border border-gray-400 rounded shadow-sm w-full py-1 px-2 text-base text-gray-800"> {{-- Ajuste de clases para mejor visualización en sidebar --}}
                                @foreach($meses as $num => $nombre)
                                    <option value="{{ $num }}" {{ (request('mes', date('n')) == $num) ? 'selected' : '' }}>
                                        {{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="ano" class="block text-sm font-medium mb-1">Año:</label>
                            <select name="ano" id="ano" class="border border-gray-400 rounded shadow-sm w-full py-1 px-2 text-base text-gray-800"> {{-- Ajuste de clases para mejor visualización en sidebar --}}
                                @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 5;
                                    $endYear = $currentYear + 1;
                                @endphp
                                @for ($year = $startYear; $year <= $endYear; $year++)
                                    <option value="{{ $year }}" {{ (request('ano', $currentYear) == $year) ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 w-full text-sm font-semibold mt-4">
                            Aplicar filtro
                        </button>
                    </form>
                </div>
                {{-- FIN DEL FORMULARIO DE FILTRO --}}

            </aside>

            {{-- Contenido principal de la página --}}
            <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center w-full mb-6">
                    <h1 class="text-3xl italic font-serif text-gray-800">Indicadores de negocio</h1>
                </div>

                {{-- Contenedor principal para los indicadores --}}
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Métricas clave</h2>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                            <h3 class="text-lg font-semibold text-blue-800">Total cuentas por cobrar</h3>
                            <p class="text-3xl font-bold text-blue-600 mt-2">
                                ${{ number_format($totalCuentasPorCobrar ?? 0, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">(Monto total pendiente)</p>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                            <h3 class="text-lg font-semibold text-green-800">Ingresos del mes</h3>
                            <p class="text-3xl font-bold text-green-600 mt-2">
                                ${{ number_format($ingresosMes ?? 0, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                (Ingresos de {{ $meses[request('mes', date('n'))] }} de {{ request('ano', date('Y')) }})
                            </p>
                        </div>

                        {{-- Puedes añadir más cards aquí --}}
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>