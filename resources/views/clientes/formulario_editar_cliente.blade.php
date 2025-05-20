<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-4">
    <div class="flex items-center justify-center mb-4">
        <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-20">
    </div>

    <div class="text-center mb-6">
        <h1 class="text-3xl italic font-serif text-gray-800">Editar cliente</h1>
    </div>

    <div class="w-full max-w-2xl border-4 border-gray-400 rounded-lg p-8 bg-white shadow-lg">
        <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') {{-- Especificamos el método HTTP PUT para la actualización --}}

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <table class="w-full">
                <tr>
                    <td class="pr-4 text-right align-top"><label for="identificacion" class="text-gray-700 text-base">Identificación</label></td>
                    <td><input type="number" name="identificacion" id="identificacion" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $cliente->identificacion }}" required readonly></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right align-top"><label for="nombre" class="text-gray-700 text-base">Nombre</label></td>
                    <td><input type="text" name="nombre" id="nombre" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $cliente->nombre }}" required></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right align-top"><label for="apellido" class="text-gray-700 text-base">Apellido</label></td>
                    <td><input type="text" name="apellido" id="apellido" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $cliente->apellido }}"></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right align-top"><label for="telefono" class="text-gray-700 text-base">Teléfono</label></td>
                    <td><input type="text" name="telefono" id="telefono" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $cliente->telefono }}"></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right align-top"><label for="direccion" class="text-gray-700 text-base">Dirección</label></td>
                    <td><input type="text" name="direccion" id="direccion" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $cliente->direccion }}"></td>
                </tr>
                <tr>
                    <td class="pr-4 text-right align-top"><label for="observaciones" class="text-gray-700 text-base">Observaciones</label></td>
                    <td><textarea name="observaciones" id="observaciones" class="w-full border border-gray-300 rounded shadow-sm h-24 px-3 text-base">{{ $cliente->observaciones }}</textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="pt-6">
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-900 mr-2">Guardar cambios</button>
                            <button type="button" onclick="window.location.href='{{ route('cuentas_por_cobrar.index') }}'" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Cancelar</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>