<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- El contenedor principal en el body para centrar todo el contenido --}}
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    {{-- Contenedor del formulario con ancho limitado y borde --}}
    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">
        {{-- Aquí se usa w-1/2 para media pantalla en Laptops (lg), w-3/4 en tablets (md) y w-11/12 en móviles --}}

        <div class="flex flex-col items-center justify-center mb-6">
            {{-- Contenedor para el logo y el título, centrado --}}
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4"> {{-- Ajusté la altura del logo a h-24 para consistencia --}}
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Registrar servicio</h1>
        </div>

        <form action="{{ route('servicios.store') }}" method="POST" class="space-y-4">
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
                    <td><input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required></td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="user_id" class="text-gray-700 text-base">Estilista</label></td>
                    <td>
                        <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled selected>Seleccione un estilista</option>
                            @foreach($estilistas as $estilista)
                                <option value="{{ $estilista->id }}">{{ $estilista->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="categoria" class="text-gray-700 text-base">Categoría</label></td>
                    <td>
                        <select name="categoria" id="categoria" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled selected>Selecciona una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria }}">{{ $categoria }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="tipo_servicio_id" class="text-gray-700 text-base">Servicio</label></td>
                    <td>
                        <select name="tipo_servicio_id" id="tipo_servicio_id" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled selected>Selecciona un servicio</option>
                            @foreach($tipoServicios as $servicio)
                                <option value="{{ $servicio->id }}"
                                        data-categoria="{{ $servicio->categoria }}"
                                        data-porcentaje="{{ $servicio->porcentaje }}"
                                        data-precio="{{ $servicio->precio }}">
                                    {{ $servicio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2"><label for="metodo_pago" class="text-gray-700 text-base">Método de pago</label></td>
                    <td>
                        <select name="metodo_pago" id="metodo_pago" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled selected>Seleccione un método</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Transferencia">Transferencia</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4 text-right py-2"><label for="observaciones" class="text-gray-700 text-base">Observaciones</label></td>
                    <td><textarea name="observaciones" id="observaciones" rows="3" class="w-full border border-gray-300 rounded shadow-sm px-3 text-base"></textarea></td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="porcentaje" class="text-gray-700 text-base">Porcentaje</label></td>
                    <td>
                        <input type="number" name="porcentaje" id="porcentaje" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base">
                        {{-- Se eliminó el atributo 'readonly' --}}
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="precio" class="text-gray-700 text-base">Precio</label></td>
                    <td>
                        <input type="number" name="precio" id="precio" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base">
                        {{-- Se eliminó el atributo 'readonly' --}}
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Registrar servicio
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
