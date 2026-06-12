<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data Dosen Riib
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <form method="POST" action="{{ route('dosen-riib.update', $dosenRiib) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    @include('dosen-riib.partials.form-fields', ['dosenRiib' => $dosenRiib])

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('dosen-riib.index') }}"
                           class="text-gray-600 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
