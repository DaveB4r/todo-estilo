<div class="flex items-center justify-center mb-4">
    <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-20">
</div>

<div class="ml-4 flex items-center">
    <h1 class="text-3xl italic font-serif text-gray-800">Editar Ingreso</h1>
</div>

<form action="{{ route('ingresos.update', $ingreso->id) }}" method="POST" class="mt-6">
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
            <td><input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $ingreso->fecha }}" required></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="entrada" class="text-gray-700 text-base">Entrada</label></td>
            <td>
                <select name="entrada" id="entrada" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Seleccione el tipo de entrada</option>
                    <option value="Saldo Inicial" {{ $ingreso->entrada == 'Saldo Inicial' ? 'selected' : '' }}>Saldo Inicial</option>
                    <option value="Insumos" {{ $ingreso->entrada == 'Insumos' ? 'selected' : '' }}>Insumos</option>
                    <option value="Préstamo" {{ $ingreso->entrada == 'Préstamo' ? 'selected' : '' }}>Préstamo</option>
                    <option value="Ajuste por transferencia" {{ $ingreso->entrada == 'Ajuste por transferencia' ? 'selected' : '' }}>Ajuste por transferencia</option>
                    <option value="Ajuste de cierre" {{ $ingreso->entrada == 'Ajuste de cierre' ? 'selected' : '' }}>Ajuste de cierre</option>
                    <option value="Tienda del peluquero" {{ $ingreso->entrada == 'Tienda del peluquero' ? 'selected' : '' }}>Tienda del peluquero</option>
                    <option value="Otros" {{ $ingreso->entrada == 'Otros' ? 'selected' : '' }}>Otros</option>
                </select>
            </td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="observacion" class="text-gray-700 text-base">Observación</label></td>
            <td><input type="text" name="observacion" id="observacion" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $ingreso->observacion }}"></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="medio_pago" class="text-gray-700 text-base">Medio de Pago</label></td>
            <td>
                <select name="medio_pago" id="medio_pago" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Seleccione el medio de pago</option>
                    <option value="Efectivo" {{ $ingreso->medio_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                    <option value="Transferencia" {{ $ingreso->medio_pago == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                </select>
            </td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="valor" class="text-gray-700 text-base">Valor</label></td>
            <td><input type="number" name="valor" id="valor" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $ingreso->valor }}" required></td>
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