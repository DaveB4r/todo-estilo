<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuentas por Cobrar - Todo Estilo</title>
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
            <aside class="w-64 bg-gray-500 shadow-md px-4 py-6 space-y-4 text-white">
                <nav class="space-y-2">
                    <a href="{{ route('clientes.create') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Crear cliente</a>
                    <a href="{{ route('cuentasPorCobrar.create') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Nueva cuenta por cobrar</a>

                    {{-- FILTRO POR ESTADO AÑADIDO --}}
                    <form action="{{ route('cuentasPorCobrar.index') }}" method="GET" class="px-1 mt-4 space-y-1">
                        <label for="estado_filter" class="block text-white text-sm font-medium">Filtrar Cuentas por Estado:</label>
                        <select name="estado" id="estado_filter" onchange="this.form.submit()" class="w-full px-2 py-1 rounded text-gray-800">
                            <option value="">-- Todos --</option>
                            <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Pagada" {{ request('estado') == 'Pagada' ? 'selected' : '' }}>Pagada</option>
                        </select>
                    </form>
                    {{-- FIN FILTRO POR ESTADO --}}
                </nav>
            </aside>

            {{-- Área de Contenido Principal --}}
            <main class="flex-1 py-4 px-6 grid grid-cols-4 gap-4">
                {{-- Acá debería salir el mensaje de confirmación --}}
                <div class="col-span-4">
                    @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none'">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none'">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                    @endif
                </div>
                <div class="flex justify-center w-full">
                    <h1 class="text-3xl italic font-serif text-gray-800">Clientes</h1>
                </div>
                <div class="col-span-1 bg-white shadow-md rounded-md p-4 overflow-y-auto h-96">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                                <th scope="col" class="relative px-3 py-2">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $cliente->nombre }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $cliente->apellido ?? '-' }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $cliente->telefono ?? '-' }}</td>
                                <td class="px-3 py-2 text-sm text-gray-900">{{ Str::limit($cliente->observaciones, 20) ?? '-' }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end items-center space-x-4">
                                        <a href="{{ route('clientes.edit', $cliente) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Borrar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($clientes->isEmpty())
                    <p class="text-gray-600 mt-2">No hay clientes.</p>
                    @endif
                </div>

                <div class="col-span-3">
                    <div class="flex justify-center w-full">
                        <h1 class="text-3xl italic font-serif text-gray-800">Cuentas por cobrar</h1>
                    </div>
                    <div class="bg-white shadow-md rounded-md p-4 overflow-y-auto h-96">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicio</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
                                    {{-- COLUMNA ESTADO AÑADIDA --}}
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    {{-- FIN COLUMNA ESTADO --}}
                                    <th scope="col" class="relative px-3 py-2">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cuentasPorCobrar as $cuenta)
                                <tr>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $cuenta->fecha }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $cuenta->cliente->nombre }} {{ $cuenta->cliente->apellido }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $cuenta->tipoServicio->nombre }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ number_format($cuenta->valor, 2) }}</td>
                                    <td class="px-3 py-2 text-sm text-gray-900">{{ Str::limit($cuenta->observaciones, 20) ?? '-' }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $cuenta->estado === 'Pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $cuenta->estado }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center space-x-4">
                                            
                                            <a href="{{ route('cuentasPorCobrar.createPago', $cuenta->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Pagar</a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($cuentasPorCobrar->isEmpty())
                        <p class="text-gray-600 mt-2">No hay cuentas por cobrar.</p>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>