<div class="flex items-center justify-center mb-4">
    <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-20">
</div>

<div class="ml-4 flex items-center">
    <h1 class="text-3xl italic font-serif text-gray-800">Editar Servicio</h1>
</div>

<form action="{{ route('servicios.update', $servicio->id) }}" method="POST" class="mt-6">
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
    @method('PUT')

    <table class="w-full space-y-4">
        <tr>
            <td class="pr-4 text-right"><label for="fecha" class="text-gray-700 text-base">Fecha</label></td>
            <td><input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $servicio->fecha }}" required></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="user_id" class="text-gray-700 text-base">Estilista</label></td>
            <td>
                <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Seleccione un estilista</option>
                    @foreach($estilistas as $estilista)
                        <option value="{{ $estilista->id }}" {{ $servicio->user_id == $estilista->id ? 'selected' : '' }}>{{ $estilista->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="categoria" class="text-gray-700 text-base">Categoría</label></td>
            <td>
                <select name="categoria" id="categoria" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Selecciona una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria }}" {{ $servicio->categoria == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                    @endforeach
                </select>
            </td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="tipo_servicio_id" class="text-gray-700 text-base">Servicio</label></td>
            <td>
                <select name="tipo_servicio_id" id="tipo_servicio_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Selecciona un servicio</option>
                    @foreach($tipoServicios as $tipoServicioOpcion)
                        <option value="{{ $tipoServicioOpcion->id }}"
                                data-categoria="{{ $tipoServicioOpcion->categoria }}"
                                data-porcentaje="{{ $tipoServicioOpcion->porcentaje }}"
                                data-precio="{{ $tipoServicioOpcion->precio }}"
                                {{ $servicio->tipo_servicio_id == $tipoServicioOpcion->id ? 'selected' : '' }}>
                            {{ $tipoServicioOpcion->nombre }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td class="text-gray-700 font-medium">Método de Pago</td>
            <td>
                <select name="metodo_pago" id="metodo_pago" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Seleccione un método</option>
                    <option value="Efectivo" {{ $servicio->metodo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                    <option value="Transferencia" {{ $servicio->metodo_pago == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="pr-4 text-right"><label for="observaciones" class="text-gray-700 text-base">Observaciones</label></td>
            <td><textarea name="observaciones" id="observaciones" rows="3" class="w-full border border-gray-300 rounded shadow-sm px-3 text-base">{{ $servicio->observaciones }}</textarea></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="porcentaje" class="text-gray-700 text-base">Porcentaje</label></td>
            <td><input type="number" name="porcentaje" id="porcentaje" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $servicio->porcentaje * 100 }}" readonly></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="precio" class="text-gray-700 text-base">Precio</label></td>
            <td><input type="number" name="precio" id="precio" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $servicio->precio }}" readonly></td>
        </tr>

        <tr>
            <td colspan="2">
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-900 mr-2">
                        Guardar Cambios
                    </button>

                    <button type="button" onclick="window.location.href='{{ url('/dashboard') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                        Cancelar
                    </button>
                </div>
            </td>
        </tr>
    </table>
</form>

<script>
document.getElementById('categoria').addEventListener('change', function () {
    const categoria = this.value;
    const servicios = document.querySelectorAll('#tipo_servicio_id option');

    servicios.forEach(option => {
        option.hidden = option.getAttribute('data-categoria') !== categoria;
        // Mostrar las opciones que coinciden con la categoría actual del servicio al cargar
        if (option.getAttribute('data-categoria') === categoria || option.value === "{{ $servicio->tipo_servicio_id }}") {
            option.hidden = false;
        }
    });

    // Si la categoría cambia, resetear la selección de servicio y los campos dependientes
    if (this.value !== "{{ $servicio->categoria }}") {
        document.getElementById('tipo_servicio_id').value = '';
        document.getElementById('porcentaje').value = '';
        document.getElementById('precio').value = '';
    } else {
        // Si la categoría no cambia, mantener los valores actuales del servicio
        const selectedService = document.querySelector('#tipo_servicio_id option[value="{{ $servicio->tipo_servicio_id }}"]');
        if (selectedService) {
            document.getElementById('porcentaje').value = selectedService.getAttribute('data-porcentaje');
            document.getElementById('precio').value = selectedService.getAttribute('data-precio');
        }
    }
});

document.getElementById('tipo_servicio_id').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    if (selected) {
        document.getElementById('porcentaje').value = selected.getAttribute('data-porcentaje');
        document.getElementById('precio').value = selected.getAttribute('data-precio');
    } else {
        document.getElementById('porcentaje').value = '';
        document.getElementById('precio').value = '';
    }
});

// Inicializar el filtro de servicios al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    const categoriaInicial = document.getElementById('categoria').value;
    const servicios = document.querySelectorAll('#tipo_servicio_id option');

    servicios.forEach(option => {
        option.hidden = option.getAttribute('data-categoria') !== categoriaInicial;
        // Asegurar que la opción seleccionada actualmente se muestre
        if (option.value === "{{ $servicio->tipo_servicio_id }}") {
            option.hidden = false;
        }
    });

    // Cargar el porcentaje y precio inicial del servicio
    const selectedService = document.querySelector('#tipo_servicio_id option[value="{{ $servicio->tipo_servicio_id }}"]');
    if (selectedService) {
        document.getElementById('porcentaje').value = selectedService.getAttribute('data-porcentaje');
        document.getElementById('precio').value = selectedService.getAttribute('data-precio');
    }
});
</script>