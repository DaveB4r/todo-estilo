<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">

        <div class="flex flex-col items-center justify-center mb-6">
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4">
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Registrar Pago de Cuenta</h1>
        </div>

        {{-- La acción del formulario apuntará a una nueva ruta para procesar el pago --}}
        <form action="{{ route('cuentasPorCobrar.storePago') }}" method="POST" class="space-y-4">
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

            {{-- Campo oculto para pasar la ID de la cuenta por cobrar --}}
            <input type="hidden" name="cuenta_por_cobrar_id" value="{{ $cuenta->id }}">

            <table class="w-full">
                <tr>
                    <td class="pr-4 text-right py-2"><label for="cliente" class="text-gray-700 text-base">Cliente</label></td>
                    <td>
                        <input type="text" id="cliente" value="{{ $cuenta->cliente->nombre }} {{ $cuenta->cliente->apellido }}" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base bg-gray-100" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2"><label for="servicio_asociado" class="text-gray-700 text-base">Servicio Asociado</label></td>
                    <td>
                        <input type="text" id="servicio_asociado" value="{{ $cuenta->tipoServicio?->nombre }}" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base bg-gray-100" readonly>
                    </td>
                </tr>
                 <tr>
                    <td class="pr-4 text-right py-2"><label for="valor_pendiente" class="text-gray-700 text-base">Valor Pendiente</label></td>
                    <td>
                        <input type="text" id="valor_pendiente" value="${{ number_format($cuenta->valor, 2) }}" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base bg-gray-100" readonly>
                    </td>
                </tr>

                {{-- Campos del Servicio --}}
                <tr>
                    <td class="pr-4 text-right py-2"><label for="fecha" class="text-gray-700 text-base">Fecha del Pago</label></td>
                    <td><input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ old('fecha', date('Y-m-d')) }}" required></td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="user_id" class="text-gray-700 text-base">Estilista</label></td>
                    <td>
                        <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled selected>Seleccione un estilista</option>
                            @foreach($estilistas as $estilista)
                                <option value="{{ $estilista->id }}" {{ old('user_id') == $estilista->id ? 'selected' : '' }}>{{ $estilista->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="categoria" class="text-gray-700 text-base">Categoría del Pago</label></td>
                    <td>
                        <select name="categoria" id="categoria" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled selected>Selecciona una categoría</option>
                            {{-- Considera tener una categoría específica para "Pagos" o "Cobros" si aplica --}}
                            
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="tipo_servicio_id" class="text-gray-700 text-base">Tipo de Servicio (Pago)</label></td>
                    <td>
                        <select name="tipo_servicio_id" id="tipo_servicio_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled selected>Selecciona un servicio</option>
                            @foreach($tipoServicios as $servicio)
                                <option value="{{ $servicio->id }}"
                                        data-categoria="{{ $servicio->categoria }}"
                                        data-porcentaje="{{ $servicio->porcentaje }}"
                                        data-precio="{{ $servicio->precio }}"
                                        {{ old('tipo_servicio_id') == $servicio->id ? 'selected' : '' }}>
                                    {{ $servicio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2"><label for="metodo_pago" class="text-gray-700 text-base">Método de Pago</label></td>
                    <td>
                        <select name="metodo_pago" id="metodo_pago" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled selected>Seleccione un método</option>
                            <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2"><label for="observaciones" class="text-gray-700 text-base">Observaciones</label></td>
                    <td><textarea name="observaciones" id="observaciones" rows="3" class="w-full border border-gray-300 rounded shadow-sm px-3 text-base">{{ old('observaciones', 'Pago de cuenta por cobrar #' . $cuenta->id . ' - Cliente: ' . $cuenta->cliente->nombre . ' ' . $cuenta->cliente->apellido) }}</textarea></td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="porcentaje" class="text-gray-700 text-base">Porcentaje</label></td>
                    <td>
                        <input type="number" name="porcentaje" id="porcentaje" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ old('porcentaje', 0) }}" required>
                        {{-- Valor por defecto 0 o el que consideres para un registro de pago --}}
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="precio" class="text-gray-700 text-base">Precio</label></td>
                    <td>
                        <input type="number" name="precio" id="precio" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" step="0.01" min="0" value="{{ old('precio', $cuenta->valor) }}" required>
                        {{-- Precarga con el valor de la cuenta por cobrar --}}
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Confirmar pago
                            </button>

                            <button type="button" onclick="window.location.href='{{ route('cuentasPorCobrar.index') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                                Cancelar
                            </button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>

        <script>
        // Los scripts para la lógica de categoría y servicio son idénticos a los de tu formulario de servicio
        document.getElementById('categoria').addEventListener('change', function () {
            const categoria = this.value;
            const servicios = document.querySelectorAll('#tipo_servicio_id option');

            servicios.forEach(option => {
                option.hidden = option.getAttribute('data-categoria') !== categoria;
            });

            document.getElementById('tipo_servicio_id').value = '';
            document.getElementById('porcentaje').value = '';
            document.getElementById('precio').value = '';
        });

        document.getElementById('tipo_servicio_id').addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            document.getElementById('porcentaje').value = selected.getAttribute('data-porcentaje');
            document.getElementById('precio').value = selected.getAttribute('data-precio');
        });
        </script>
    </div>
</body>
</html>