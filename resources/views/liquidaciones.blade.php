<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liquidaciones - Todo Estilo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-100">


        <div class="flex min-h-screen bg-gray-100">
            <aside class="w-64 bg-gray-500 shadow-md px-4 py-6 space-y-4 text-white">
                <h2 class="text-xl font-semibold mb-2">Filtrar Liquidaciones</h2>
                <form action="{{ route('liquidaciones.index') }}" method="GET" class="space-y-4">
                    <div class="mb-2">
                        <label for="fecha_inicio" class="block text-gray-100 text-sm font-bold mb-1">Fecha Inicial:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $fechaInicio ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="fecha_fin" class="block text-gray-100 text-sm font-bold mb-1">Fecha Final:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $fechaFin ?? '' }}">
                    </div>
                    <div>
                        <button type="submit" class="block px-3 py-2 rounded hover:bg-gray-800 text-white font-medium w-full text-center">
                            Filtrar
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('liquidaciones.index') }}" class="block px-3 py-2 rounded hover:bg-gray-800 text-white font-medium text-center">
                            Limpiar Filtro
                        </a>
                    </div>
                </form>
            </aside>

            <main class="flex-1 py-4 px-6">
                <div class="flex justify-center w-full">
                    <h1 class="text-3xl italic font-serif text-gray-800">Liquidaciónde servicios</h1>
                </div>
                @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif

                @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @endif

                @forelse ($serviciosPorUsuario as $nombreUsuario => $servicios)
                <h2 class="text-xl font-semibold mt-6 mb-2">Servicios de {{ $nombreUsuario }}</h2>
                <table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                            <th class="px-5 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipo de Servicio</th>
                            <th class="px-5 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Precio</th>
                            <th class="px-5 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Porcentaje</th>
                            <th class="px-5 py-3 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Liquidación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($servicios as $servicio)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $servicio->fecha }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $servicio->tipo_servicio }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($servicio->precio, 2) }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($servicio->porcentaje * 100, 2) }}%</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ number_format($servicio->precio * $servicio->porcentaje, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">No hay servicios para este usuario con el filtro aplicado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @empty
                <p>No hay servicios registrados.</p>
                @endforelse
            </main>
        </div>
    </div>
</body>

</html>