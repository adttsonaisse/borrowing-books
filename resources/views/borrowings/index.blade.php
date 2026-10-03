<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowings Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('borrowings.create') }}" class="underline">Add Data</a>
                    <table class="mt-3 w-full">
                        <thead>
                            <tr class="bg-gray-800 text-white text-left">
                                <th class="p-3">No</th>
                                <th class="p-3">Student</th>
                                <th class="p-3">Class</th>
                                <th class="p-3">Book</th>
                                <th class="p-3">Borrow Date</th>
                                <th class="p-3">Return Date</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrowings as $b)
                                <tr class="p-3 text-left">
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $b->student_name }}</td>
                                    <td class="p-3">{{ $b->classroom }}</td>
                                    <td class="p-3">{{ $b->book?->title ?? '-' }}</td>
                                    <td class="p-3">{{ $b->borrow_date?->format('Y-m-d') }}</td>
                                    <td class="p-3">{{ $b->return_date?->format('Y-m-d') ?? '-' }}</td>
                                    <td class="p-3">{{ $b->return_date ? 'Returned' : 'Borrowed' }}</td>
                                    <td class="p-3 flex gap-3 items-center">
                                        <a href="{{ route('borrowings.edit', $b) }}">
                                            <x-primary-button>Edit</x-primary-button>
                                        </a>
                                        <form action="{{ route('borrowings.destroy', $b) }}" method="post">
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
