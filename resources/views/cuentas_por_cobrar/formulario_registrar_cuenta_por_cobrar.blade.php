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
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4"> {{-- Altura unificada --}}
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Registrar cuenta por cobrar</h1>
        </div>

        <form action="{{ route('cuentas_por_cobrar.store') }}" method="POST" class="space-y-4">
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
                    <td class="pr-4 text-right py-2"><label for="fecha" class="text-gray-700 text-base">Fecha</label></td>
                    <td>
                        <input
                            type="date"
                            name="fecha"
                            id="fecha"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('fecha', date('Y-m-d')) }}" {{-- Se preselecciona la fecha actual --}}
                            required
                        >
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="cliente_id" class="text-gray-700 text-base">Cliente</label></td>
                    <td>
                        <select
                            name="cliente_id"
                            id="cliente_id"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            required
                        >
                            <option value="" disabled {{ !old('cliente_id') ? 'selected' : '' }}>Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option
                                    value="{{ $cliente->identificacion }}"
                                    {{ old('cliente_id') == $cliente->identificacion ? 'selected' : '' }}
                                >
                                    {{ $cliente->nombre }} {{ $cliente->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="servicio_id" class="text-gray-700 text-base">Servicio</label></td>
                    <td>
                        <select
                            name="servicio_id"
                            id="servicio_id"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            required
                        >
                            <option value="" disabled {{ !old('servicio_id') ? 'selected' : '' }}>Seleccione un servicio</option>
                            @foreach($tiposServicio as $servicio)
                                <option
                                    value="{{ $servicio->id }}"
                                    data-precio="{{ $servicio->precio }}"
                                    {{ old('servicio_id') == $servicio->id ? 'selected' : '' }}
                                >
                                    {{ $servicio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="valor" class="text-gray-700 text-base">Valor</label></td>
                    <td>
                        <input
                            type="number"
                            name="valor"
                            id="valor"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('valor') }}"
                            required
                            min="0"
                            step="0.01" {{-- Permite decimales --}}
                            placeholder="Ej: 150000.00"
                        >
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2 align-top"><label for="observaciones" class="text-gray-700 text-base">Observaciones</label></td>
                    <td>
                        <textarea
                            name="observaciones"
                            id="observaciones"
                            rows="3"
                            class="w-full border border-gray-300 rounded shadow-sm px-3 py-2 text-base"
                            placeholder="Notas adicionales sobre la cuenta por cobrar..."
                        >{{ old('observaciones') }}</textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Registrar cuenta por cobrar
                            </button>

                            <button type="button" onclick="window.location.href='{{ route('cuentas_por_cobrar.index') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                                Cancelar
                            </button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const servicioSelect = document.getElementById('servicio_id');
            const valorInput = document.getElementById('valor');

            function actualizarPrecio() {
                const selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
                let precio = selectedOption ? selectedOption.getAttribute('data-precio') : '';

                if (precio) {
                    // Eliminar comas de miles si existen y convertir a número flotante
                    precio = parseFloat(precio.replace(/,/g, ''));
                    // Asignar el valor formateado a dos decimales, o dejar vacío si no es un número válido
                    valorInput.value = isNaN(precio) ? '' : precio.toFixed(2);
                } else {
                    valorInput.value = '';
                }
            }

            servicioSelect.addEventListener('change', actualizarPrecio);

            // Llamar a la función al cargar la página para prellenar el valor
            // si un servicio ya está seleccionado (por ejemplo, si se usa old())
            if (servicioSelect.value) {
                actualizarPrecio();
            }
        });
    </script>
</body>
</html>