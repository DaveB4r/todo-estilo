<div class="flex items-center justify-center mb-4">
    <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-20">
</div>

<div class="ml-4 flex items-center">
    <h1 class="text-3xl italic font-serif text-gray-800">Registrar Salida</h1>
</div>

<form action="{{ route('salidas.store') }}" method="POST" class="mt-6">
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

    <table class="w-full space-y-4">
        <tr>
            <td class="pr-4 text-right"><label for="fecha" class="text-gray-700 text-base">Fecha</label></td>
            <td><input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="salida" class="text-gray-700 text-base">Salida</label></td>
            <td>
                <select name="salida" id="salida" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled selected>Seleccione el tipo de salida</option>
                    <option value="Arriendo">Arriendo</option>
                    <option value="Servicios públicos">Servicios públicos</option>
                    <option value="Nómina">Nómina</option>
                    <option value="Ajuste por transferencia">Ajuste por transferencia</option>
                    <option value="Ajuste cierre">Ajuste cierre</option>
                    <option value="Pago a proveedor">Pago a proveedor</option>
                    <option value="Otros">Otros</option>
                </select>
            </td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="observacion" class="text-gray-700 text-base">Observación</label></td>
            <td><input type="text" name="observacion" id="observacion" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"></td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="medio_pago" class="text-gray-700 text-base">Medio de Pago</label></td>
            <td>
                <select name="medio_pago" id="medio_pago" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled selected>Seleccione el medio de pago</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
            </td>
        </tr>

        <tr>
            <td class="pr-4 text-right"><label for="valor" class="text-gray-700 text-base">Valor</label></td>
            <td><input type="number" name="valor" id="valor" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required></td>
        </tr>

        <tr>
            <td colspan="2">
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">
                        Registrar Salida
                    </button>

                    <button type="button" onclick="window.location.href='{{ url('/dashboard') }}'" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900">
                        Cancelar
                    </button>
                </div>
            </td>
        </tr>
    </table>
</form>