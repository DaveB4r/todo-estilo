<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Contenedor principal para centrar todo el contenido en la pantalla --}}

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    {{-- Contenedor del formulario con ancho limitado, borde y sombra --}}
    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">
        {{-- Aquí se usa w-1/2 para media pantalla en Laptops (lg), w-3/4 en tablets (md) y w-11/12 en móviles --}}

        {{-- Contenedor para el logo y el título, ambos centrados --}}
        <div class="flex flex-col items-center justify-center mb-6">
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4"> {{-- Ajustada la altura del logo a h-24 para consistencia con el otro formulario --}}
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Editar servicio</h1>
        </div>

        <form action="{{ route('tipo_servicios.update', $tipoServicio->id) }}" method="POST" class="space-y-4">
            @method('PUT') {{-- O @method('PATCH') --}}
            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @csrf
            <table class="w-full">
                <tr>
                    <td class="pr-4 text-right py-2"><label for="nombre" class="text-gray-700 text-base">Nombre del servicio</label></td>
                    <td><input type="text" name="nombre" id="nombre" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $tipoServicio->nombre }}" required></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2">
                        <label for="categoria" class="text-gray-700 text-base">Categoría</label>
                    </td>
                    <td>
                        <select name="categoria" id="categoria" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled>Selecciona una categoría</option>
                            <option value="Peluquería" {{ $tipoServicio->categoria === 'Peluquería' ? 'selected' : '' }}>Peluquería</option>
                            <option value="Uñas" {{ $tipoServicio->categoria === 'Uñas' ? 'selected' : '' }}>Uñas</option>
                            <option value="Maquillaje" {{ $tipoServicio->categoria === 'Maquillaje' ? 'selected' : '' }}>Maquillaje</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2"><label for="descripcion" class="text-gray-700 text-base">Descripción</label></td>
                    <td>
                        <input
                            type="text"
                            name="descripcion"
                            id="descripcion"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ $tipoServicio->descripcion }}"
                            required>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2">
                        <label for="porcentaje" class="text-gray-700 text-base">Porcentaje de liquidación</label>
                    </td>
                    <td>
                        <input
                            type="number"
                            name="porcentaje"
                            id="porcentaje"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ $tipoServicio->porcentaje }}"
                            required
                            min="0"
                            max="100"
                            step="0.01"
                            placeholder="Ej: 25.5">
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2">
                        <label for="precio" class="text-gray-700 text-base">Precio</label>
                    </td>
                    <td>
                        <input
                            type="number"
                            name="precio"
                            id="precio"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ intval($tipoServicio->precio) }}" {{-- ¡ESTE ES EL CAMBIO CLAVE! --}}
                            required
                            min="0"
                            step="1"
                            placeholder="Ej: 15000">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> {{-- Para que los botones abarquen ambas columnas y puedan centrarse --}}
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">Guardar cambios</button>
                            <button type="button" onclick="window.location.href='{{ route('tipo_servicios.index') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">Cancelar</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>