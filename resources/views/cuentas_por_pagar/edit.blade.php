<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Título de la página --}}
    <title>{{ config('app.name', 'Todo Estilo') }} - Editar cuenta por pagar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">

        <div class="flex flex-col items-center justify-center mb-6">
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4">
            {{-- Título del formulario --}}
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Editar cuenta por pagar</h1>
        </div>

        {{-- Formulario para editar una cuenta por pagar --}}
        {{-- action apunta a la ruta de actualización y le pasa el ID de la cuenta --}}
            <form action="{{ route('cuentas-por-pagar.update', $cuentaPorPagar->id) }}" method="POST" class="space-y-4">
                       @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf {{-- Token CSRF para seguridad --}}
            @method('PUT') {{-- Indica a Laravel que esta es una solicitud PUT/PATCH para actualizar --}}

            <table class="w-full">
                <tr>
                    <td class="pr-4 text-right py-2"><label for="descripcion" class="text-gray-700 text-base">Descripción</label></td>
                    <td>
                        <input
                            type="text"
                            name="descripcion"
                            id="descripcion"
                            class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                            {{-- Rellena con el valor actual o el valor 'old' si hay un error --}}
                            value="{{ old('descripcion', $cuentaPorPagar->descripcion) }}"
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
                            value="{{ old('valor', $cuentaPorPagar->valor) }}"
                            required
                            min="0"
                            step="1"
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
                            {{-- Formatea la fecha para que el input type="date" la reconozca --}}
                            value="{{ old('fecha_vencimiento', $cuentaPorPagar->fecha_vencimiento->format('Y-m-d')) }}"
                            required
                        >
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="estado" class="text-gray-700 text-base">Estado</label></td>
                    <td>
                        <select name="estado" id="estado" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled>Seleccione un estado</option>
                            {{-- Marca la opción 'Pendiente' si es la actual o el valor 'old' --}}
                            <option value="Pendiente" {{ old('estado', $cuentaPorPagar->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            {{-- Marca la opción 'Paga' si es la actual o el valor 'old' --}}
                            <option value="Paga" {{ old('estado', $cuentaPorPagar->estado) == 'Paga' ? 'selected' : '' }}>Paga</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            {{-- Texto del botón de envío --}}
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Actualizar Cuenta
                            </button>

                            {{-- Botón para cancelar y volver al listado --}}
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