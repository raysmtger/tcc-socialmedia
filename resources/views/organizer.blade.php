<x-app-layout>
    {{-- Barra superior --}}
    <nav class="bg-orange-400 p-4 flex justify-between items-center">
        <div class="font-bold text-black text-lg">MidiaHelper</div>
        <div class="space-x-6 text-white font-medium">
            <a href="{{ route('organizer') }}" class="hover:underline">organizer</a>
            <a href="#" class="hover:underline">promptIA</a>
        </div>
        <div>
            <a href="{{ route('profile.edit') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 fill-white" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.2 0-9.5 1.6-9.5 4.9V22h19v-2.7c0-3.3-6.3-4.9-9.5-4.9z"/></svg>
            </a>
        </div>
    </nav>

    {{-- Boas-vindas --}}
    <div class="bg-orange-400 text-center py-10 text-black">
        <h1 class="text-3xl font-bold">Olá, {{ $user->name }} 👋</h1>
        <p class="text-lg mt-2">O que vamos criar hoje?</p>
        <button class="bg-black text-white px-4 py-2 rounded-lg mt-4 hover:bg-gray-800">
            (botão para criar)
        </button>
    </div>

    {{-- Cards das ideias --}}
    <div class="max-w-7xl mx-auto mt-10 px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($ideas as $idea)
                <div class="bg-orange-200 p-5 rounded-2xl shadow text-center">
                    <h2 class="text-lg font-bold text-gray-800">{{ $idea->title }}</h2>
                    <p class="text-sm text-gray-600 mt-1">Prazo: {{ $idea->deadline }}</p>
                    <p class="text-sm mt-3 font-medium text-yellow-700">{{ $idea->status }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
