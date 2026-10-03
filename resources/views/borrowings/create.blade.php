<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Borrowing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('borrowings.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="student_name" :value="__('Student Name')" />
                            <x-text-input id="student_name" class="block mt-1 w-full" type="text" name="student_name"
                                :value="old('student_name')" required autofocus autocomplete="off" />
                            <x-input-error :messages="$errors->get('student_name')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="classroom" :value="__('Classroom')" />
                            <x-text-input id="classroom" class="block mt-1 w-full" type="text" name="classroom"
                                :value="old('classroom')" required autocomplete="off" />
                            <x-input-error :messages="$errors->get('classroom')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="book_id" :value="__('Book')" />
                            <x-select-input name="book_id" id="book_id" class="block mt-1 w-full">
                                <option value="" disabled @selected(!old('book_id'))>Choose Book</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" @selected(old('book_id') == $book->id) @disabled($book->stock <= 0)>
                                        {{ $book->title }} (stock: {{ $book->stock }})
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="borrow_date" :value="__('Borrow Date')" />
                            <x-text-input id="borrow_date" class="block mt-1 w-full" type="date" name="borrow_date"
                                :value="old('borrow_date', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('borrow_date')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="return_date" :value="__('Return Date (empty if not returned)')" />
                            <x-text-input id="return_date" class="block mt-1 w-full" type="date" name="return_date"
                                :value="old('return_date')" />
                            <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                        </div>
                        <br>
                        <x-primary-button type="submit">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
