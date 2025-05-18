<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
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
                </div>
            </div>
        </div>
    </nav>

    <div class="flex min-h-screen bg-gray-100">
        <aside class="w-35 bg-gray-500 shadow-md px-3 py-2 space-y-4">
            <nav class="space-y-2">
                <a href="{{ route('usuarios.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Usuarios</a>
                <a href="{{ route('tipo_servicios.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Tipo de servicios</a>
                <a href="{{ route('servicios.create') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">
                    Registrar Servicios
                </a>
                <a href="{{ route('ingresos.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Ingresos</a>
                <a href="{{ route('salidas.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Salidas</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Liquidación de empleados</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Cuentas por cobrar</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Indicadores</a>
                <a href="#" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Cuadre de caja</a>
            </nav>
        </aside>

        <div class="w-full">
            @if(session('success'))
            <div class="w-full h-8 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 flex items-center justify-between shadow">
                <span class="text-sm">
                    {{ session('success') }}
                </span>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900 font-bold text-base leading-none">&times;</button>
            </div>
            @endif
            <div class="flex justify-center w-full ">
                <h1 class="text-3xl italic font-serif text-gray-800">Resumen de servicios diarios</h1>
            </div>

            @php
            $servicios = App\Models\Servicio::all();

            $agrupadoPorFecha = $servicios->groupBy('fecha');
            @endphp

            <div class="space-y-4">
                @foreach($agrupadoPorFecha as $fecha => $serviciosDia)
                @php
                $totalDia = $serviciosDia->sum('precio');
                $id = 'detalle-' . str_replace('-', '', $fecha);
                $serviciosPorEmpleado = $serviciosDia->groupBy('user_id');
                @endphp

                <div class="bg-white shadow rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-800">{{ $fecha }}</span>
                        <div class="flex items-center gap-4">
                            <span class="text-green-600 font-bold">$ {{ number_format($totalDia, 0) }}</span>
                            <button onclick="document.getElementById('{{ $id }}').classList.toggle('hidden')" class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-900">
                                Detalle
                            </button>
                        </div>
                    </div>

                    <div id="{{ $id }}" class="hidden mt-4">
                        <h3 class="font-semibold text-gray-700 mb-2">Detalle por empleado:</h3>
                        <div class="space-y-4">
                            @foreach($serviciosPorEmpleado as $empleadoId => $serviciosEmpleado)
                            @php
                            $empleado = App\Models\User::find($empleadoId);
                            @endphp
                            @if($empleado)
                            <div class="bg-gray-100 rounded-md p-2">
                                <h4 class="font-semibold text-gray-700 mb-2">{{ $empleado->name }}</h4>
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Servicio
                                            </th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Valor
                                            </th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Medio de Pago
                                            </th>
                                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($serviciosEmpleado as $servicio)
                                        @php
                                        $tipoServicio = App\Models\TipoServicio::find($servicio->tipo_servicio_id);
                                        @endphp
                                        @if($tipoServicio)
                                        <tr>
                                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                                {{ $tipoServicio->nombre }}
                                            </td>
                                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                                $ {{ number_format($servicio->precio, 0) }}
                                            </td>
                                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                                {{ $servicio->metodo_pago }}
                                            </td>
                                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm **flex items-center**">
                                                <a href="{{ route('servicios.edit', $servicio->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Editar</a>
                                                <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar este servicio?')">Borrar</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm text-red-500">
                                                Servicio no encontrado (ID: {{ $servicio->tipo_servicio_id }})
                                            </td>
                                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                                $ {{ number_format($servicio->precio, 0) }}
                                            </td>
                                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                                {{ $servicio->metodo_pago }}
                                            </td>
                                            <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                                                <a href="{{ route('servicios.edit', $servicio->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2 **inline-block**">Editar</a>
                                                <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" class="**inline-block**">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar este servicio?')">Borrar</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Total
                                            </td>
                                            <td class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                $ {{ number_format($serviciosEmpleado->sum('precio'), 0) }}
                                            </td>
                                            <td class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                                            </td>
                                            <td class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @else
                            <div class="bg-gray-100 rounded-md p-2">
                                <span class="font-medium text-gray-600">Empleado ID: {{ $empleadoId }} - <span class="text-red-500">Empleado no encontrado</span></span>
                                <ul class="list-disc list-inside text-sm text-gray-500 ml-4">
                                    @foreach($serviciosEmpleado as $servicio)
                                    @php
                                    $tipoServicio = App\Models\TipoServicio::find($servicio->tipo_servicio_id);
                                    @endphp
                                    @if($tipoServicio)
                                    <li>{{ $tipoServicio->nombre }}: $ {{ number_format($servicio->precio, 0) }} ({{ $servicio->metodo_pago }})</li>
                                    @else
                                    <li>Servicio ID: {{ $servicio->tipo_servicio_id }}: $ {{ number_format($servicio->precio, 0) }} ({{ $servicio->metodo_pago }}) - <span class="text-red-500">Tipo de servicio no encontrado</span></li>
                                    @endif
                                    @endforeach
                                </ul>
                                <span class="font-semibold text-gray-600 ml-4">Total empleado: $ {{ number_format($serviciosEmpleado->sum('precio'), 0) }}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</html>