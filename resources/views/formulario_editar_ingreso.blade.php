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
    {{-- Agregué 'p-4' al body para un pequeño padding en pantallas muy pequeñas --}}

    {{-- Contenedor del formulario con ancho limitado y borde --}}
    <div class="bg-white p-8 rounded-lg shadow-xl border-4 border-gray-400 w-11/12 md:w-3/4 lg:w-1/2">
        {{-- Aquí se usa w-1/2 para media pantalla en Laptops (lg), w-3/4 en tablets (md) y w-11/12 en móviles --}}

        <div class="flex flex-col items-center justify-center mb-6">
            {{-- Contenedor para el logo y el título, centrado --}}
            <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-24 mb-4">
            <h1 class="text-3xl italic font-serif text-gray-800 text-center">Editar ingreso</h1>
        </div>

        <form action="{{ route('ingresos.update', $ingreso->id) }}" method="POST" class="space-y-4">
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
                    <td><input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ old('fecha', $ingreso->fecha) }}" required></td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="entrada" class="text-gray-700 text-base">Entrada</label></td>
                    <td>
                        <select name="entrada" id="entrada" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled>Seleccione el tipo de entrada</option>
                            <option value="Saldo Inicial" {{ old('entrada', $ingreso->entrada) == 'Saldo Inicial' ? 'selected' : '' }}>Saldo Inicial</option>
                            <option value="Insumos" {{ old('entrada', $ingreso->entrada) == 'Insumos' ? 'selected' : '' }}>Insumos</option>
                            <option value="Préstamo" {{ old('entrada', $ingreso->entrada) == 'Préstamo' ? 'selected' : '' }}>Préstamo</option>
                            <option value="Ajuste por transferencia" {{ old('entrada', $ingreso->entrada) == 'Ajuste por transferencia' ? 'selected' : '' }}>Ajuste por transferencia</option>
                            <option value="Ajuste de cierre" {{ old('entrada', $ingreso->entrada) == 'Ajuste de cierre' ? 'selected' : '' }}>Ajuste de cierre</option>
                            <option value="Tienda del peluquero" {{ old('entrada', $ingreso->entrada) == 'Tienda del peluquero' ? 'selected' : '' }}>Tienda del peluquero</option>
                            <option value="Otros" {{ old('entrada', $ingreso->entrada) == 'Otros' ? 'selected' : '' }}>Otros</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="observacion" class="text-gray-700 text-base">Observación</label></td>
                    <td><input type="text" name="observacion" id="observacion" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ old('observacion', $ingreso->observacion) }}"></td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="medio_pago" class="text-gray-700 text-base">Medio de Pago</label></td>
                    <td>
                        <select name="medio_pago" id="medio_pago" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                            <option value="" disabled>Seleccione el medio de pago</option>
                            <option value="Efectivo" {{ old('medio_pago', $ingreso->medio_pago) == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="Transferencia" {{ old('medio_pago', $ingreso->medio_pago) == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="pr-4 text-right py-2"><label for="valor" class="text-gray-700 text-base">Valor</label></td>
                    <td><input type="number" name="valor" id="valor" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ old('valor', $ingreso->valor) }}" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                                Guardar cambios
                            </button>

                            <button type="button" onclick="window.location.href='{{ url('/ingresos') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
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