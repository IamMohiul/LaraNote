<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('notes.update', $note) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Title
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-green-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" name="title" value="{{ old('title', $note->title) }}">
                        @error('title')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                        <br />
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Note Description
                    </label>
                    <textarea name="text" rows="10" placeholder="Start Typing Here..." class="appearance-none block w-full bg-gray-200 text-gray-700 border border-green-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name">{{ old('text', $note->text) }}</textarea>
                        @error('text')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                        <br />
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                        Save Note
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
