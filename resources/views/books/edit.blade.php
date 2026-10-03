<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title', $book->title)" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <x-select-input name="category_id" id="category_id">
                                <option value="" disabled @selected(!old('category_id', $book->category_id))>Choose Category</option>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}" @selected(old('category_id', $book->category_id) == $c->id)>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                                :value="old('author', $book->author)" required autocomplete="author" />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="publisher" :value="__('Publisher')" />
                            <x-text-input id="publisher" class="block mt-1 w-full" type="text" name="publisher"
                                :value="old('publisher', $book->publisher)" required autocomplete="publisher" />
                            <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="year" :value="__('Year')" />

                            <x-text-input id="year" class="block mt-1 w-full" type="number" name="year"
                                :value="old('year', $book->year)" min="1900" max="{{ date('Y') }}" required />

                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="image" :value="__('Photo')" />
                            @if ($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="h-20 mt-2">
                            @endif
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock"
                                :value="old('stock', $book->stock)" required autocomplete="stock" />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                        <br>
                        <x-primary-button type="submit">Update</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
