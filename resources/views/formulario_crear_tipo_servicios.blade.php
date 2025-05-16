<div class="flex items-center justify-center mb-4">
    <img src="/img/Logo_todo_estilo.png" alt="Logo" class="h-20">
</div>

<div class="ml-4 flex items-center">
    <h1 class="text-3xl italic font-serif text-gray-800">Crear un nuevo servicio</h1>
</div>

        <form action="{{ route('tipo_servicios.store') }}" method="POST" class="space-y-4">
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
            <td><input type="text" name="nombre" id="nombre" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required></td>
        </tr>
        <tr>
    <td class="pr-4 text-right">
        <label for="categoria" class="text-gray-700 text-base">Categoría</label>
    </td>
        <td>
            <select name="categoria" id="categoria" class="w-full border border-gray-300 rounded shadow-sm h-10 px-3 text-base" required>
                <option value="" disabled selected>Selecciona una categoría</option>
                <option value="Peluquería">Peluquería</option>
                <option value="Uñas">Uñas</option>
                <option value="Maquillaje">Maquillaje</option>
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
                    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 mr-2">Crear servicio</button>
                    <button type="button" onclick="window.location.href='{{ route('usuarios.index') }}'" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Cancelar</button>
                </div>
            </td>
        </tr>
    </table>
</form>