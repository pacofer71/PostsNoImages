<x-app-layout>
    <x-principal>
        <h1 class="mb-8 text-center text-2xl text-purple-400 font-bold font-mono">{{ $texto }}</h1>
        <div class="grid grid-cols-3 gap-x-2 gap-y-3">
            @foreach ($posts as $item)
                <article
                    class="h-96 flex flex-col justify-between  p-4 rounded-lg border-2 border-gray-300 shadow-xl overflow-y-auto" style="background-color: #FFEB3B">
                    <div class="text-xl font-semibold text-purple-700 text-center mb-5">
                        {{ $item->titulo }}
                    </div>
                    <div class="italic text-purple-600 font-mono twxt-sm">
                        {{ $item->contenido }}
                    </div>
                    <div class="flex justify-center italic text-blue-700 text-sm my-5 cursor-pointer">
                        <a href="{{ route('inicio', ['email', $item->user->id]) }}">{{ $item->user->email }}</a>
                    </div>
                    <div class="flex w-full">
                        @foreach ($item->tags as $tag)
                            <div class="px-1 py-2 rounded-xl text-sm mr-1 italic font-semibold"
                                style="background-color:{{ $tag->color }}">
                                <a href="{{ route('inicio', ['tag', $tag->id]) }}">#{{ $tag->nombre }}</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-end italic text-sm text-purple-600">
                        {{ $item->updated_at->format('d/m/Y h:i') }}
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-2">
            {{ $posts->links() }}
        </div>
    </x-principal>

</x-app-layout>
