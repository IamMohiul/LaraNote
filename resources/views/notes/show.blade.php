<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('notes.show') ? __('Notes') : __('Trash')}}
        </h2>
    </x-slot>
    <br/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="flex">
                @if (!$note->trashed())
                    <p class="opacity-70">
                        <Strong>Createed :</Strong> {{ $note->created_at->diffForHumans() }}
                    </p>
                    <br/>
                    <p class="opacity-70 ml-8">
                        <Strong>Updated :</Strong> {{ $note->updated_at->diffForHumans() }}
                    </p>
                    <a href="{{ route('notes.edit', $note) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto">Edit Note</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST" class="px-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are You Sure Move This Note to Trash?')">
                            Move to trash
                        </button>
                    </form>
                @else
                    <p class="opacity-70">
                        <Strong>Deleted :</Strong> {{ $note->deleted_at->diffForHumans() }}
                    </p>

                    <form action="{{ route('trashed.restore', $note) }}" method="POST" class="ml-auto">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto">Restore Note</button>
                    </form>

                    <form action="{{ route('trashed.destroy', $note) }}" method="POST" class="px-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are You Sure To Delete Forever?')">
                            Delete Forever
                        </button>
                    </form>
                @endif

            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $note->title }}
                </h2>
                <p class="mt-6 whitespace-pre-wrap">{{$note->text}}</p>
            </div>
        </div>
    </div>
</x-app-layout>
