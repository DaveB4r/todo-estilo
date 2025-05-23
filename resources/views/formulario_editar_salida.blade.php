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
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4"> {{-- Altura unificada con otros formularios --}}
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Editar salida</h1>
        </div>

        <form action="{{ route('salidas.update', $salida->id) }}" method="POST" class="space-y-4"> {{-- Añadido space-y-4 para espaciado --}}
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

            <table class="w-full"> {{-- Tabla para la estructura del formulario --}}
                <tr>
                    <td class="pr-4 text-right py-2"><label for="fecha" class="text-gray-700 text-base">Fecha</label></td>
                    <td>
                        <input
                            type="date"
                            name="fecha"
                            id="fecha"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('fecha', $salida->fecha) }}" {{-- Usamos old() para repoblar el campo --}}
                            required
                        >
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="salida" class="text-gray-700 text-base">Salida</label></td>
                    <td>
                        <select name="salida" id="salida" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled {{ !old('salida', $salida->salida) ? 'selected' : '' }}>Seleccione el tipo de salida</option>
                            <option value="Arriendo" {{ old('salida', $salida->salida) == 'Arriendo' ? 'selected' : '' }}>Arriendo</option>
                            <option value="Servicios públicos" {{ old('salida', $salida->salida) == 'Servicios públicos' ? 'selected' : '' }}>Servicios públicos</option>
                            <option value="Nómina" {{ old('salida', $salida->salida) == 'Nómina' ? 'selected' : '' }}>Nómina</option>
                            <option value="Ajuste por transferencia" {{ old('salida', $salida->salida) == 'Ajuste por transferencia' ? 'selected' : '' }}>Ajuste por transferencia</option>
                            <option value="Ajuste cierre" {{ old('salida', $salida->salida) == 'Ajuste cierre' ? 'selected' : '' }}>Ajuste cierre</option>
                            <option value="Pago a proveedor" {{ old('salida', $salida->salida) == 'Pago a proveedor' ? 'selected' : '' }}>Pago a proveedor</option>
                            <option value="Otros" {{ old('salida', $salida->salida) == 'Otros' ? 'selected' : '' }}>Otros</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="observacion" class="text-gray-700 text-base">Observación</label></td>
                    <td>
                        <input
                            type="text"
                            name="observacion"
                            id="observacion"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            value="{{ old('observacion', $salida->observacion) }}" {{-- Usamos old() --}}
                        >
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="medio_pago" class="text-gray-700 text-base">Medio de Pago</label></td>
                    <td>
                        <select name="medio_pago" id="medio_pago" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled {{ !old('medio_pago', $salida->medio_pago) ? 'selected' : '' }}>Seleccione el medio de pago</option>
                            <option value="Efectivo" {{ old('medio_pago', $salida->medio_pago) == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="Transferencia" {{ old('medio_pago', $salida->medio_pago) == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
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
                            value="{{ old('valor', $salida->valor) }}" {{-- Usamos old() --}}
                            required
                            min="0" {{-- Aseguramos que el valor no sea negativo --}}
                            step="1" {{-- Permite solo números enteros --}}
                            placeholder="Ej: 50000"
                        >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Guardar cambios
                            </button>

                            <button type="button" onclick="window.location.href='{{ url('/salidas') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
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