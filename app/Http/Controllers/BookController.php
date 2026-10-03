<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'year' => 'required|integer|digits:4',
            'image' => 'required|image|max:4096',
            'stock' => 'required|integer'
        ]);

        $validated['image'] = $request->file('image')->store('books', 'public');

        Book::query()->create($validated);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'year' => 'required|integer',
            'image' => 'nullable|image|max:4096',
            'stock' => 'required|integer'
        ]);

        if($request->hasFile('image')) {
            Storage::disk('public')->delete($book->image);

            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($validated);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        Storage::disk('public')->delete($book->image);

        return redirect()->route('books.index');
    }
}
