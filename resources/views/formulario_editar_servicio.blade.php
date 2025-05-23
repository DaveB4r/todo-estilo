<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">

        {{-- Contenedor para el logo y el título, ambos centrados --}}
        <div class="flex flex-col items-center justify-center mb-6">
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4">
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Editar servicio</h1>
        </div>

        <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" class="space-y-4">
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

            <table class="w-full">
                <tr>
                    <td class="pr-4 text-right py-2"><label for="fecha" class="text-gray-700 text-base">Fecha</label></td>
                    <td><input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ old('fecha', $servicio->fecha) }}" required></td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="user_id" class="text-gray-700 text-base">Estilista</label></td>
                    <td>
                        <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled>Seleccione un estilista</option>
                            @foreach($estilistas as $estilista)
                                <option value="{{ $estilista->id }}" {{ old('user_id', $servicio->user_id) == $estilista->id ? 'selected' : '' }}>{{ $estilista->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="categoria" class="text-gray-700 text-base">Categoría</label></td>
                    <td>
                        <select name="categoria" id="categoria" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled>Selecciona una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria }}" {{ old('categoria', $servicio->categoria) == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="tipo_servicio_id" class="text-gray-700 text-base">Servicio</label></td>
                    <td>
                        <select name="tipo_servicio_id" id="tipo_servicio_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled>Selecciona un servicio</option>
                            @foreach($tipoServicios as $tipoServicioOpcion)
                                <option value="{{ $tipoServicioOpcion->id }}"
                                        data-categoria="{{ $tipoServicioOpcion->categoria }}"
                                        data-porcentaje="{{ $tipoServicioOpcion->porcentaje }}"
                                        data-precio="{{ $tipoServicioOpcion->precio }}"
                                        {{ old('tipo_servicio_id', $servicio->tipo_servicio_id) == $tipoServicioOpcion->id ? 'selected' : '' }}>
                                    {{ $tipoServicioOpcion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2"><label for="metodo_pago" class="text-gray-700 text-base">Método de pago</label></td>
                    <td>
                        <select name="metodo_pago" id="metodo_pago" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled>Seleccione un método</option>
                            <option value="Efectivo" {{ old('metodo_pago', $servicio->metodo_pago) == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="Transferencia" {{ old('metodo_pago', $servicio->metodo_pago) == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2"><label for="observaciones" class="text-gray-700 text-base">Observaciones</label></td>
                    <td><textarea name="observaciones" id="observaciones" rows="3" class="w-full border border-gray-300 rounded shadow-sm px-3 text-base">{{ old('observaciones', $servicio->observaciones) }}</textarea></td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="porcentaje" class="text-gray-700 text-base">Porcentaje</label></td>
                    <td>
                        <input
                            type="number"
                            name="porcentaje"
                            id="porcentaje"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('porcentaje', $servicio->porcentaje * 100) }}"
                            required
                            min="0"
                            max="100"
                            step="0.01"
                            placeholder="Ej: 25.5"
                        >
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="precio" class="text-gray-700 text-base">Precio</label></td>
                    <td>
                        <input
                            type="number"
                            name="precio"
                            id="precio"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('precio', $servicio->precio) }}"
                            required
                            min="0"
                            step="1"
                            placeholder="Ej: 15000"
                        >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Guardar cambios
                            </button>
                            <button type="button" onclick="window.location.href='{{ url('/dashboard') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                                Cancelar
                            </button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        // Mantiene la lógica del JavaScript para actualizar porcentaje y precio
        // CUANDO el usuario cambia el tipo de servicio o categoría.

        const categoriaSelect = document.getElementById('categoria');
        const tipoServicioSelect = document.getElementById('tipo_servicio_id');
        const porcentajeInput = document.getElementById('porcentaje');
        const precioInput = document.getElementById('precio');

        // Función para filtrar los servicios según la categoría seleccionada
        function filterTipoServicios() {
            const categoria = categoriaSelect.value;
            const serviciosOptions = tipoServicioSelect.querySelectorAll('option');

            serviciosOptions.forEach(option => {
                const dataCategoria = option.getAttribute('data-categoria');
                if (option.value === "") { // Mostrar la opción "Selecciona un servicio"
                    option.hidden = false;
                } else {
                    option.hidden = dataCategoria !== categoria;
                }
            });

            // Si el servicio seleccionado actualmente no coincide con la nueva categoría,
            // o si la categoría seleccionada es diferente a la categoría original del servicio,
            // entonces resetear el tipo de servicio y los campos de porcentaje/precio.
            const currentSelectedTipoServicioId = tipoServicioSelect.value;
            const selectedTipoServicioOption = tipoServicioSelect.querySelector(`option[value="${currentSelectedTipoServicioId}"]`);
            const selectedTipoServicioCategoria = selectedTipoServicioOption ? selectedTipoServicioOption.getAttribute('data-categoria') : null;

            if (categoria !== "{{ $servicio->categoria }}" || (currentSelectedTipoServicioId && selectedTipoServicioCategoria !== categoria)) {
                tipoServicioSelect.value = ''; // Resetea la selección del servicio
                porcentajeInput.value = '';    // Limpia porcentaje
                precioInput.value = '';        // Limpia precio
            } else {
                // Si la categoría es la misma que la original y el tipo de servicio es el mismo que el original,
                // reestablecer los valores de porcentaje y precio del servicio actual.
                if (categoria === "{{ $servicio->categoria }}" && tipoServicioSelect.value === "{{ $servicio->tipo_servicio_id }}") {
                    porcentajeInput.value = "{{ $servicio->porcentaje * 100 }}";
                    precioInput.value = "{{ $servicio->precio }}";
                }
            }
        }

        // Función para actualizar el porcentaje y precio cuando se selecciona un TipoServicio
        function updatePorcentajePrecioFromTipoServicio() {
            const selected = tipoServicioSelect.options[tipoServicioSelect.selectedIndex];
            if (selected && selected.value !== "") {
                porcentajeInput.value = selected.getAttribute('data-porcentaje');
                precioInput.value = selected.getAttribute('data-precio');
            } else {
                porcentajeInput.value = '';
                precioInput.value = '';
            }
        }

        // Event Listeners
        categoriaSelect.addEventListener('change', filterTipoServicios);
        tipoServicioSelect.addEventListener('change', updatePorcentajePrecioFromTipoServicio);


        // Lógica de inicialización al cargar la página
        document.addEventListener('DOMContentLoaded', function () {
            // Cargar el porcentaje y precio actual del servicio, no del TipoServicio
            porcentajeInput.value = "{{ old('porcentaje', $servicio->porcentaje * 100) }}";
            precioInput.value = "{{ old('precio', $servicio->precio) }}";

            // Asegurar que solo los servicios de la categoría actual estén visibles al cargar
            filterTipoServicios();
        });
    </script>
</body>
</html>