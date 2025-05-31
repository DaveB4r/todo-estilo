<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }} - Cuentas por Pagar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        {{-- Barra de Navegación Superior --}}
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

        {{-- Contenido Principal: Sidebar y Área de Contenido --}}
        <div class="flex min-h-screen bg-gray-100">
            {{-- Barra Lateral (Sidebar) --}}
            <aside class="w-35 bg-gray-500 shadow-md px-1 py-2 space-y-4">
                <nav class="space-y-2">
                    <a href="{{ route('cuentas-por-pagar.create') }}"
                    class="block px-1 py-2 rounded hover:bg-gray-700 text-white font-medium">
                    Registrar nueva cuenta por pagar
                    </a>

                    <form action="{{ route('cuentas-por-pagar.index') }}" method="GET" class="px-1 mt-2 space-y-1">
                        <label for="estado" class="block text-white text-sm font-medium">Filtrar por estado:</label>
                        <select name="estado" id="estado" onchange="this.form.submit()" class="w-full px-2 py-1 rounded">
                            <option value="">-- Todos --</option>
                            <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Paga" {{ request('estado') == 'Paga' ? 'selected' : '' }}>Paga</option>
                        </select>
                    </form>
                </nav>
            </aside>

            {{-- CAMBIO CLAVE AQUÍ: Asegurar que el aside tome toda la altura dentro del flex --}}

 

            {{-- Área de Contenido Principal --}}
            <main class="flex-1 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Listado de Cuentas por Pagar</h2>
            @if (session('success'))
                <div id="success-alert" class="bg-green-100 text-green-700 p-3 rounded-lg shadow-md flex justify-between items-center mb-4">
                    <div>{{ session('success') }}</div>
                    <button type="button" class="text-green-700 hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50"
                            onclick="document.getElementById('success-alert').style.display='none';">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

                @if ($cuentasPorPagar->isEmpty())
                    <p class="text-gray-600">No hay cuentas por pagar registradas.</p>
                @else
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Vencimiento</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Acciones</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cuentasPorPagar as $cuenta)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cuenta->descripcion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($cuenta->valor, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $cuenta->fecha_vencimiento->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $cuenta->estado === 'Pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $cuenta->estado }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        {{-- Enlace para editar (si lo tienes) --}}
                                        <a href="{{ route('cuentas-por-pagar.edit', $cuenta->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Editar</a>
                                        {{-- <form action="{{ route('cuentas-por-pagar.destroy', $cuenta->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                        </form> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </main>
        </div>
    </div>
</body>

</html>