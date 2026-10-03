<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    protected $fillable = [
        'student_name',
        'classroom',
        'book_id',
        'borrow_date',
        'return_date',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
