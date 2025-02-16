<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BorrowBookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowBook;
use App\Models\Student;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(BorrowBookDataTable $datatable)
    {

        $borrowedBook = BorrowBook::query()->with(['student', 'book'])->first();
        return $datatable->render('admin.library.borrowed-books', compact('borrowedBook'));

    }


    public function borrow(Request $request)
    {
        $request->validate([
            'student_id' => ['required'],
        ]);


        $book = Book::query()->findOrFail($request->book_id);

        if (!$book->isAvailable()) {
            return redirect()->back()->with('error', 'This book is currently unavailable.');
        }

        $book = new BorrowBook();

        $book->book_id = $request->input('book_id');
        $book->student_id = $request->input('student_id');
        $book->borrow_date = now();
        $book->status = false;
        $book->save();

        toastr()->success('Borrowed book successfully.');

        return redirect()->route('borrowedBooks');

    }

    public function returnBook(Request $request, string $id)
    {
        $request->validate([
            'student_id' => ['integer'],
            'book_id' => ['integer'],
        ]);

        $borrowedBook = BorrowBook::query()->findOrFail($id);

        if (!$borrowedBook) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update the status to "Cleared" and set the returned date
        $borrowedBook->status = true;
        $borrowedBook->returned_date = now();

        dd($borrowedBook);

        $borrowedBook->save();

        toastr()->success('Returned book successfully.');

        return redirect()->back();

    }
}
