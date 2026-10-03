<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('book')->latest()->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::orderBy('title')->get();

        return view('borrowings.create', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'classroom' => 'required|string|max:50',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:borrow_date',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if (empty($validated['return_date']) && $book->stock <= 0) {
            return back()->withInput()->withErrors([
                'book_id' => 'Stok buku habis.',
            ]);
        }

        Borrowing::create($validated);

        if (empty($validated['return_date'])) {
            $book->decrement('stock');
        }

        return redirect()->route('borrowings.index');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load('book');

        return view('borrowings.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing)
    {
        $books = Book::orderBy('title')->get();

        return view('borrowings.edit', compact('borrowing', 'books'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'classroom' => 'required|string|max:50',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:borrow_date',
        ]);

        // Cek stok dulu sebelum ubah apa-apa
        if (empty($validated['return_date'])) {
            $newBook = Book::findOrFail($validated['book_id']);
            $bonus = ($borrowing->book_id == $newBook->id && $borrowing->return_date === null) ? 1 : 0;

            if ($newBook->stock + $bonus <= 0) {
                return back()->withInput()->withErrors([
                    'book_id' => 'Stok buku habis.',
                ]);
            }
        }

        // Kembalikan stok buku lama kalau belum dikembalikan
        if ($borrowing->return_date === null) {
            $oldBook = Book::findOrFail($borrowing->book_id);
            $oldBook->increment('stock');
        }

        // Kurangi stok buku baru kalau belum dikembalikan
        if (empty($validated['return_date'])) {
            $newBook = Book::findOrFail($validated['book_id']);
            $newBook->decrement('stock');
        }

        $borrowing->update($validated);

        return redirect()->route('borrowings.index');
    }

    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->return_date === null) {
            $book = Book::findOrFail($borrowing->book_id);
            $book->increment('stock');
        }

        $borrowing->delete();

        return redirect()->route('borrowings.index');
    }
}
