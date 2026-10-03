<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowing Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Student: {{ $borrowing->student_name }}</p>
                    <p>Class: {{ $borrowing->classroom }}</p>
                    <p>Book: {{ $borrowing->book?->title ?? '-' }}</p>
                    <p>Borrow Date: {{ $borrowing->borrow_date?->format('Y-m-d') }}</p>
                    <p>Return Date: {{ $borrowing->return_date?->format('Y-m-d') ?? '-' }}</p>
                    <br>
                    <a href="{{ route('borrowings.index') }}" class="underline">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
