<div class="flex items-center justify-center mb-4">
    <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-20">
</div>

<div class="ml-4 flex items-center">
    <h1 class="text-3xl italic font-serif text-gray-800">Editar servicio</h1>
</div>

<form action="{{ route('tipo_servicios.update', $tipoServicio->id) }}" method="POST" class="space-y-4">
    @method('PUT') {{-- O @method('PATCH') --}}
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
    <table>
        <tr>
            <td class="pr-4 text-right"><label for="nombre" class="text-gray-700 text-base">Nombre del servicio</label></td>
            <td><input type="text" name="nombre" id="nombre" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" value="{{ $tipoServicio->nombre }}" required></td>
        </tr>
        <tr>
            <td class="pr-4 text-right">
                <label for="categoria" class="text-gray-700 text-base">Categoría</label>
            </td>
            <td>
                <select name="categoria" id="categoria" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                    <option value="" disabled>Selecciona una categoría</option>
                    <option value="Peluquería" {{ $tipoServicio->categoria === 'Peluquería' ? 'selected' : '' }}>Peluquería</option>
                    <option value="Uñas" {{ $tipoServicio->categoria === 'Uñas' ? 'selected' : '' }}>Uñas</option>
                    <option value="Maquillaje" {{ $tipoServicio->categoria === 'Maquillaje' ? 'selected' : '' }}>Maquillaje</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="pr-4 text-right"><label for="descripcion" class="text-gray-700 text-base">Descripción</label></td>
            <td>
                <input
                    type="text"
                    name="descripcion"
                    id="descripcion"
                    class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                    value="{{ $tipoServicio->descripcion }}"
                    required
                >
            </td>
        </tr>
        <tr>
            <td class="pr-4 text-right">
                <label for="porcentaje" class="text-gray-700 text-base">Porcentaje de liquidación</label>
            </td>
            <td>
                <input
                    type="number"
                    name="porcentaje"
                    id="porcentaje"
                    class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                    value="{{ $tipoServicio->porcentaje }}"
                    required
                    min="0"
                    max="100"
                    step="0.01"
                    placeholder="Ej: 25.5"
                >
            </td>
        </tr>
        <tr>
            <td class="pr-4 text-right">
                <label for="precio" class="text-gray-700 text-base">Precio</label>
            </td>
            <td>
                <input
                    type="number"
                    name="precio"
                    id="precio"
                    class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base"
                    value="{{ $tipoServicio->precio }}"
                    required
                    min="0"
                    step="1"
                    placeholder="Ej: 15000"
                >
            </td>
        </tr>
        <tr>
            <td>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-900 mr-2">Guardar cambios</button>
                    <button type="button" onclick="window.location.href='{{ route('tipo_servicios.index') }}'" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Cancelar</button>
                </div>
            </td>
        </tr>
    </table>
</form>