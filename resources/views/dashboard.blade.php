<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <img class="h-12 w-auto" src="/img/Logo_todo_estilo.png" alt="Logo">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight italic font-serif">
                Todo Estilo - Panel de Control
            </h2>
        </div>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        <!-- Panel lateral -->
        <aside class="w-64 bg-white shadow-md px-4 py-6 space-y-4">
            <nav class="space-y-2">
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200 text-gray-700 font-medium">Ingresos</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200 text-gray-700 font-medium">Egresos</a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200 text-gray-700 font-medium">Registrar Servicios</a>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Bienvenido/a al panel de Todo Estilo</h1>
            <div class="bg-white shadow rounded-lg p-6">
                <p class="text-gray-700 text-lg">
                    ¡Has iniciado sesión exitosamente! Aquí podrás gestionar tus ingresos, egresos y servicios del salón.
                </p>
            </div>
        </main>
    </div>
</x-app-layout>