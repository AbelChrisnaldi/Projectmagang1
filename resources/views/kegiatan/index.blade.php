<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 font-bold text-lg border-b">
                Dashboard
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('kegiatan.index') }}"
                   class="block px-4 py-2 rounded hover:bg-blue-100">
                    📋 Lihat Data
                </a>

                <a href="{{ route('kegiatan.index') }}#form"
                   class="block px-4 py-2 rounded hover:bg-blue-100">
                    ➕ Input Data
                </a>
            </nav>
        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</x-app-layout>
