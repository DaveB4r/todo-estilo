<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuadre de Caja - Todo Estilo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <img class="h-14 w-auto" src="/img/Logo_todo_estilo.png" alt="Logo">
                        </div>
                        <div class="ml-4 flex items-center">
                            <h1 class="text-3xl italic font-serif text-gray-800">Todo Estilo</h1>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900 px-3 py-2">
                                Cerrar sesión
                            </button>
                        </form>
                        @endauth
                        <a href="/dashboard" class="text-gray-600 hover:text-gray-900 px-3 py-2">Regresar</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex min-h-screen bg-gray-100">
            {{-- Aside / Sidebar --}}
            <aside class="w-64 bg-gray-500 shadow-md px-4 py-6 space-y-4 text-white">
                <h3 class="text-lg font-semibold mb-4">Filtrar cuadre de caja</h3>
                <form action="{{ route('cuadre_de_caja') }}" method="GET" class="space-y-4">
                    <div>
                        <label for="mes" class="block text-sm font-medium text-gray-200">Mes:</label>
                        {{-- INICIO DEL ARRAY DE MESES Y SELECTOR --}}
                        @php
                            $meses = [
                                1 => 'Enero',
                                2 => 'Febrero',
                                3 => 'Marzo',
                                4 => 'Abril',
                                5 => 'Mayo',
                                6 => 'Junio',
                                7 => 'Julio',
                                8 => 'Agosto',
                                9 => 'Septiembre',
                                10 => 'Octubre',
                                11 => 'Noviembre',
                                12 => 'Diciembre'
                            ];
                        @endphp
                        <select name="mes" id="mes" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md text-gray-900">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ (request('mes', date('n')) == $m) ? 'selected' : '' }}>
                                    {{ $meses[$m] }} {{-- Usamos el array de meses aquí --}}
                                </option>
                            @endforeach
                        </select>
                        {{-- FIN DEL ARRAY DE MESES Y SELECTOR --}}
                    </div>
                    <div>
                        <label for="ano" class="block text-sm font-medium text-gray-200">Año:</label>
                        <select name="ano" id="ano" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md text-gray-900">
                            @php
                                $currentYear = date('Y');
                                $startYear = $currentYear - 5; // Por ejemplo, 5 años atrás
                                $endYear = $currentYear + 1;   // Hasta el próximo año
                            @endphp
                            @foreach (range($endYear, $startYear) as $y) {{-- Rango del año en orden descendente --}}
                                <option value="{{ $y }}" {{ (request('ano', date('Y')) == $y) ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">
                         Filtrar
                     </button>
                </form>

                <nav class="space-y-2 mt-8">
                    {{-- Otros enlaces de navegación si los necesitas --}}
                    <a href="{{ route('indicadores.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700 text-white font-medium">Indicadores</a>
                </nav>
            </aside>

            {{-- Contenido principal de la página --}}
            <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center w-full">
                <h1 class="text-3xl italic font-serif text-gray-800">Cuadre de caja</h1>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 w-full mx-auto"> {{-- Añadimos mx-auto para centrar si el padre no lo hace --}}

    {{-- Contenedor de la grilla, que ahora puede centrar sus elementos si son más pequeños --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 justify-items-center">

{{-- Contenedor del Saldo Total en Efectivo --}}
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center max-w-xs w-full flex flex-col items-center">
    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Saldo total en efectivo (caja)</h3>

    {{-- Contenedor Flex para el Saldo Calculado y la Casilla de Saldo Real --}}
    <div class="flex items-center justify-center space-x-4 w-full"> {{-- Usamos space-x-4 para un margen entre ellos --}}
        <p style="font-size: 35px;" class="font-bold text-green-700 mt-2" id="saldo-efectivo-calculado">
            ${{ number_format($saldoEfectivo ?? 0, 0, ',', '.') }}
        </p>
        <input type="number" id="saldo_efectivo_real" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-24 text-lg" placeholder="Real" step="0.01" min="0"> {{-- w-24 para ancho fijo, text-lg para un tamaño legible --}}
    </div>

    <p class="text-base text-gray-500 mt-1">
        (Saldo en caja a
        {{ $meses[request('mes', date('n'))] }} de {{ request('ano', date('Y')) }})
    </p>

    <p id="resultado-efectivo" class="mt-2 font-semibold"></p> {{-- El resultado se mostrará aquí --}}
</div>

{{-- Contenedor del Saldo Total en Transferencia --}}
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center max-w-xs w-full flex flex-col items-center">
    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Saldo total en transferencia (cuenta Bancolombia)</h3>

    {{-- Contenedor Flex para el Saldo Calculado y la Casilla de Saldo Real --}}
    <div class="flex items-center justify-center space-x-4 w-full"> {{-- Usamos space-x-4 para un margen entre ellos --}}
        <p style="font-size: 35px;" class="font-bold text-gray-800 mt-2" id="saldo-transferencia-calculado">
            ${{ number_format($saldoTransferencia ?? 0, 0, ',', '.') }}
        </p>
        <input type="number" id="saldo_transferencia_real" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-24 text-lg" placeholder="Real" step="0.01" min="0"> {{-- w-24 para ancho fijo, text-lg para un tamaño legible --}}
    </div>

    <p class="text-base text-gray-500 mt-1">
        (Saldo en la cuenta a
        {{ $meses[request('mes', date('n'))] }} de {{ request('ano', date('Y')) }})
    </p>

    <p id="resultado-transferencia" class="mt-2 font-semibold"></p> {{-- El resultado se mostrará aquí --}}
</div>
</div>

{{-- Contenedor para el único botón de comparación --}}
<div class="flex justify-center mt-6">
<button onclick="compararAmbosSaldos()" class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-900 text-lg font-semibold shadow-md">
    Comparar saldos
</button>
</div>

<script>
function compararAmbosSaldos() {
const realizarComparacion = (saldoCalculadoElementId, saldoRealInputId, resultadoElementId, mensajeFaltante, mensajeSobrante, currencyCode) => {
    const saldoCalculadoText = document.getElementById(saldoCalculadoElementId).innerText;
    const saldoCalculado = parseFloat(saldoCalculadoText.replace('$', '').replace(/\./g, '').replace(',', '.'));

    const saldoRealInput = document.getElementById(saldoRealInputId);
    const saldoReal = parseFloat(saldoRealInput.value);

    const resultadoElement = document.getElementById(resultadoElementId);

    if (isNaN(saldoReal)) {
        resultadoElement.innerText = 'Ingrese un valor real válido.';
        resultadoElement.classList.remove('text-green-700', 'text-red-700');
        resultadoElement.classList.add('text-gray-600');
        return;
    }

    const diferencia = saldoReal - saldoCalculado;

    const formatoMoneda = new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: currencyCode,
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });

    if (diferencia < 0) {
        resultadoElement.innerText = mensajeFaltante + formatoMoneda.format(Math.abs(diferencia));
        resultadoElement.classList.remove('text-green-700', 'text-gray-600');
        resultadoElement.classList.add('text-red-700');
    } else if (diferencia > 0) {
        resultadoElement.innerText = mensajeSobrante + formatoMoneda.format(diferencia);
        resultadoElement.classList.remove('text-red-700', 'text-gray-600');
        resultadoElement.classList.add('text-green-700');
    } else {
        resultadoElement.innerText = 'Los saldos coinciden.';
        resultadoElement.classList.remove('text-green-700', 'text-red-700');
        resultadoElement.classList.add('text-gray-600');
    }
};

realizarComparacion(
    'saldo-efectivo-calculado',
    'saldo_efectivo_real',
    'resultado-efectivo',
    'Faltante: ', // Mensaje más corto para que quepa mejor
    'Sobrante: ', // Mensaje más corto
    'COP'
);

realizarComparacion(
    'saldo-transferencia-calculado',
    'saldo_transferencia_real',
    'resultado-transferencia',
    'Faltante: ', // Mensaje más corto
    'Sobrante: ', // Mensaje más corto
    'COP'
);
}
</script>
            </main>
        </div>
    </div>
</body>

</html>