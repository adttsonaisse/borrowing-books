<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('books.create') }}" class="underline">Add Data</a>
                    <table class="mt-3 w-full">
                        <thead>
                            <tr class="bg-gray-800 text-white text-left">
                                <th class="p-3">No</th>
                                <th class="p-3">Title</th>
                                <th class="p-3">Category</th>
                                <th class="p-3">Author</th>
                                <th class="p-3">Publisher</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Stock</th>
                                <th class="p-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $b)
                                <tr class="p-3 text-left">
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3 flex items-center gap-3">
                                        <img src="{{ asset('storage/' . $b->image) }}" width="50" alt="{{ $b->title }}">
                                        {{ $b->title }}
                                    </td>
                                    <td class="p-3">{{ $b->category?->name ?? '-' }}</td>
                                    <td class="p-3">{{ $b->author }}</td>
                                    <td class="p-3">{{ $b->publisher }}</td>
                                    <td class="p-3">{{ $b->year }}</td>
                                    <td class="p-3">{{ $b->stock }}</td>
                                    <td class="p-3 flex gap-3 items-center">
                                        <a href="{{ route('books.edit', $b) }}">
                                            <x-primary-button>Edit</x-primary-button>
                                        </a>
                                        <form action="{{ route('books.destroy', $b) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>Delete</x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
