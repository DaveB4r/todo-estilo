<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- El contenedor principal en el body para centrar todo el contenido --}}
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    {{-- Contenedor del formulario con ancho limitado y borde --}}
    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">
        {{-- Aquí se usa w-1/2 para media pantalla en Laptops (lg), w-3/4 en tablets (md) y w-11/12 en móviles --}}

        <div class="flex flex-col items-center justify-center mb-6">
            {{-- Contenedor para el logo y el título, centrado --}}
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4"> {{-- Ajusté la altura del logo a h-24 para consistencia --}}
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Editar usuario</h1>
        </div>

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') {{-- Especificamos el método PUT para la actualización --}}

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
                    <td class="pr-4 text-right py-2 align-top"><label for="nombre" class="text-gray-700 text-base">Nombre</label></td>
                    <td><input type="text" name="nombre" id="nombre" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $usuario->name }}" required></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="telefono" class="text-gray-700 text-base">Teléfono</label></td>
                    <td><input type="text" name="telefono" id="telefono" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $usuario->telefono }}"></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="direccion" class="text-gray-700 text-base">Dirección</label></td>
                    <td><input type="text" name="direccion" id="direccion" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $usuario->direccion }}"></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="email" class="text-gray-700 text-base">Correo electrónico</label></td>
                    <td><input type="email" name="email" id="email" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $usuario->email }}" required></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="password" class="text-gray-700 text-base">Contraseña</label></td>
                    <td><input type="password" name="password" id="password" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" placeholder="Dejar en blanco para no cambiar"></td>
                </tr>
                <tr>
                    <td colspan="2"> {{-- Los botones abarcan ambas columnas --}}
                        <div class="flex justify-center mt-6"> {{-- Centramos los botones --}}
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">Guardar cambios</button>
                            <button type="button" onclick="window.location.href='{{ route('usuarios.index') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">Cancelar</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>