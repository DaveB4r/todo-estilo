<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo Estilo') }} - Registrar cuenta por pagar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- El contenedor principal en el body para centrar todo el contenido --}}
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    {{-- Contenedor del formulario con ancho limitado y borde --}}
    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">
        {{-- Aquí se usa w-1/2 para media pantalla en Laptops (lg), w-3/4 en tablets (md) y w-11/12 en móviles --}}

        <div class="flex flex-col items-center justify-center mb-6">
            {{-- Contenedor para el logo y el título, centrado --}}
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4"> {{-- Altura unificada con otros formularios --}}
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Registrar nueva cuenta por pagar</h1>
        </div>

        {{-- Formulario para crear una nueva cuenta por pagar --}}
        {{-- CAMBIO AQUÍ: 'cuentas-por-pagar.store' --}}
        <form action="{{ route('cuentas-por-pagar.store') }}" method="POST" class="space-y-4">
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf {{-- ¡Importante para seguridad en Laravel! --}}

            <table class="w-full"> {{-- Tabla para la estructura del formulario --}}
                <tr>
                    <td class="pr-4 text-right py-2"><label for="descripcion" class="text-gray-700 text-base">Descripción</label></td>
                    <td>
                        <input
                            type="text"
                            name="descripcion"
                            id="descripcion"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('descripcion') }}" {{-- Usamos old() para repoblar en caso de error --}}
                            placeholder="Ej: Pago a proveedor de telas"
                            required
                        >
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
                            value="{{ old('valor') }}" {{-- Usamos old() --}}
                            required
                            min="0" {{-- Aseguramos que el valor no sea negativo --}}
                            step="1" {{-- Permite solo números enteros --}}
                            placeholder="Ej: 150000"
                        >
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="fecha_vencimiento" class="text-gray-700 text-base">Fecha de Vencimiento</label></td>
                    <td>
                        <input
                            type="date"
                            name="fecha_vencimiento"
                            id="fecha_vencimiento"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('fecha_vencimiento') }}" {{-- Usamos old() --}}
                            required
                        >
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="estado" class="text-gray-700 text-base">Estado</label></td>
                    <td>
                        <select name="estado" id="estado" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled {{ !old('estado') ? 'selected' : '' }}>Seleccione un estado</option>
                            <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Paga" {{ old('estado') == 'Paga' ? 'selected' : '' }}>Paga</option> {{-- Corregido 'Pago' a 'Paga' para consistencia con 'Paga' en el validador del controlador --}}
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Registrar cuenta
                            </button>

                            {{-- Botón para cancelar y volver al listado de cuentas por pagar --}}
                            {{-- CAMBIO AQUÍ: 'cuentas-por-pagar.index' --}}
                            <button type="button" onclick="window.location.href='{{ route('cuentas-por-pagar.index') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                                Cancelar
                            </button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>