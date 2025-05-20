<div class="flex items-center justify-center mb-4">
    <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-20">
</div>

<div class="ml-4 flex items-center">
    <h1 class="text-3xl italic font-serif text-gray-800">Editar Cuenta por Cobrar</h1>
</div>

<form action="{{ route('cuentas_por_cobrar.update', $cuentaPorCobrar) }}" method="POST" class="mt-6">
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
    @method('PUT') {{-- Especificamos el método HTTP PUT para la actualización --}}

    <table class="w-full space-y-4">
        <tr>
            <td class="pr-4 text-right"><label for="fecha" class="text-gray-700 text-base">Fecha</label></td>
            <td><input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $cuentaPorCobrar->fecha }}" required></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="cliente_id" class="text-gray-700 text-base">Cliente</label></td>
            <td>
                <select name="cliente_id" id="cliente_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->identificacion }}" {{ $cuentaPorCobrar->cliente_id == $cliente->identificacion ? 'selected' : '' }}>
                            {{ $cliente->nombre }} {{ $cliente->apellido }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="servicio_id" class="text-gray-700 text-base">Servicio</label></td>
            <td>
                <select name="servicio_id" id="servicio_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Seleccione un servicio</option>
                    @foreach($tiposServicio as $servicio)
                        <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}" {{ $cuentaPorCobrar->servicio_id == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->nombre }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="valor" class="text-gray-700 text-base">Valor</label></td>
            <td><input type="number" name="valor" id="valor" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $cuentaPorCobrar->valor }}"></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="observaciones" class="text-gray-700 text-base">Observaciones</label></td>
            <td><textarea name="observaciones" id="observaciones" rows="3" class="w-full border border-gray-300 rounded shadow-sm px-3 text-base">{{ $cuentaPorCobrar->observaciones }}</textarea></td>
        </tr>

        <tr>
            <td colspan="2">
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-900 mr-2">
                        Guardar Cambios
                    </button>

                    <button type="button" onclick="window.location.href='{{ route('cuentas_por_cobrar.index') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                        Cancelar
                    </button>
                </div>
            </td>
        </tr>
    </table>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const servicioSelect = document.getElementById('servicio_id');
        const valorInput = document.getElementById('valor');

        function actualizarPrecio() {
            const selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
            const precio = selectedOption ? selectedOption.getAttribute('data-precio') : '';
            valorInput.value = precio ? precio.split(',')[0] : '';
        }

        servicioSelect.addEventListener('change', actualizarPrecio);

        // Llamar a la función al cargar la página para el valor inicial
        actualizarPrecio();
    });
</script>