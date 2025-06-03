<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- El contenedor principal en el body para centrar todo el contenido --}}

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    {{-- Contenedor del formulario con ancho limitado y borde --}}
    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">
        {{-- Aquí se usa w-1/2 para media pantalla en Laptops (lg), w-3/4 en tablets (md) y w-11/12 en móviles --}}

        <div class="flex flex-col items-center justify-center mb-6">
            {{-- Contenedor para el logo y el título, centrado --}}
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4"> {{-- Altura unificada con otros formularios --}}
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Editar cliente</h1>
        </div>

        <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') {{-- Especificamos el método HTTP PUT para la actualización --}}

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <table class="w-full">
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="identificacion" class="text-gray-700 text-base">Identificación</label></td>
                    <td>
                        <input
                            type="number"
                            name="identificacion"
                            id="identificacion"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base bg-gray-100 cursor-not-allowed" {{-- Añadido bg-gray-100 y cursor-not-allowed para un campo de solo lectura --}}
                            value="{{ old('identificacion', $cliente->identificacion) }}"
                            required
                            readonly {{-- El campo de identificación es solo de lectura para evitar cambios --}}
                            min="0"
                            step="1">
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="nombre" class="text-gray-700 text-base">Nombre</label></td>
                    <td>
                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('nombre', $cliente->nombre) }}"
                            required
                            placeholder="Ej: Juan">
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="apellido" class="text-gray-700 text-base">Apellido</label></td>
                    <td>
                        <input
                            type="text"
                            name="apellido"
                            id="apellido"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('apellido', $cliente->apellido) }}"
                            placeholder="Ej: Pérez">
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="telefono" class="text-gray-700 text-base">Teléfono</label></td>
                    <td>
                        <input
                            type="tel" {{-- Cambié a type="tel" para indicar que es un número de teléfono --}}
                            name="telefono"
                            id="telefono"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('telefono', $cliente->telefono) }}"
                            placeholder="Ej: 3001234567">
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="direccion" class="text-gray-700 text-base">Dirección</label></td>
                    <td>
                        <input
                            type="text"
                            name="direccion"
                            id="direccion"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('direccion', $cliente->direccion) }}"
                            placeholder="Ej: Calle 10 # 20-30">
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="observaciones" class="text-gray-700 text-base">Observaciones</label></td>
                    <td>
                        <textarea
                            name="observaciones"
                            id="observaciones"
                            class="w-full border border-gray-300 rounded shadow-sm h-24 px-3 py-2 text-base" {{-- Agregué py-2 para padding vertical en textarea --}}
                            placeholder="Notas adicionales sobre el cliente...">{{ old('observaciones', $cliente->observaciones) }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Guardar cambios
                            </button>
                            <button type="button" onclick="window.location.href='{{ route('cuentasPorCobrar.index') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                                Cancelar
                            </button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>