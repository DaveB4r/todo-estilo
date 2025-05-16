<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
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
                        <a href="/dashboard" class="text-gray-600 hover:text-gray-900 px-3 py-2">Regresar</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex min-h-screen bg-gray-100">
            <aside class="w-35 bg-gray-500 shadow-md px-5 py-2 space-y-4">
                <nav class="space-y-2">
                    <a href="{{ route('formulario_registrar_salida') }}" class="block px-5 py-2 rounded hover:bg-gray-700 text-white font-medium">Registrar nueva salida</a>
                </nav>
            </aside>

            <main class="p-6 w-full">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Lista de Salidas</h2>

                @if(session('success'))
                <div class="w-full h-8 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 flex items-center justify-between shadow">
                    <span class="text-sm">
                        {{ session('success') }}
                    </span>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900 font-bold text-base leading-none">&times;</button>
                </div>
                @endif

                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Salida
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Observación
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Medio de Pago
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Valor
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Editar y Borrar</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($salidas as $salida)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $salida->fecha }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $salida->salida }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $salida->observacion }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $salida->medio_pago }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    $ {{ number_format($salida->valor, 0) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center justify-end gap-4">
                                    <a href="{{ route('salidas.edit', $salida->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <form class="inline-block" action="{{ route('salidas.destroy', $salida->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta salida?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No hay salidas registradas
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>