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
            <aside class="w-64 bg-gray-500 shadow-md px-4 py-6 space-y-4 text-white">
                <nav class="space-y-2">
                    <a href="{{ route('clientes.create') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Crear Cliente</a>
                    <a href="{{ route('cuentas_por_cobrar.create') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Nueva Cuenta por Cobrar</a>
                </nav>
            </aside>
            <main class="flex-1 py-4 px-6 grid grid-cols-4 gap-4">
                <div class="col-span-1 bg-white shadow-md rounded-md p-4 overflow-y-auto h-96">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Clientes</h2>
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
                    <h1 class="text-3xl font-semibold mb-4">Cuentas por Cobrar</h1>

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

                    <div class="bg-white shadow-md rounded-md p-4 overflow-y-auto h-96">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicio</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observaciones</th>
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
                                    <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center space-x-4">
                                            <a href="{{ route('cuentas_por_cobrar.edit', $cuenta) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                            <form action="{{ route('cuentas_por_cobrar.destroy', $cuenta) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Borrar</button>
                                            </form>
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