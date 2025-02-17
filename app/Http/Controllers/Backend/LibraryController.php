<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BorrowBookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowBook;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(BorrowBookDataTable $datatable)
    {

        return $datatable->render('admin.library.borrowed-books');

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

        return redirect()->route('borrowed.books');

    }

    public function returnBook(string $id)
    {
        $borrowedBook = BorrowBook::query()
            ->with(['student', 'book'])
            ->findOrFail($id);
        $grades = Grade::all();
        $subject= Subject::all();


        return view('admin.library.return-book', compact('borrowedBook', 'grades', 'subject'));
    }

    public function returnBookStore(Request $request, string $id)
    {

        $request->validate([
            'student_id' => ['required'],
            'book_id' => ['required'],
        ]);


        $borrowedBook = BorrowBook::query()->findOrFail($id);

        if (!$borrowedBook) {
            return response()->json(['error' => 'This book is not available in the return record.'], 404);
        }

        $borrowedBook->status = true;
        $borrowedBook->returned_date = now();

//        dd($borrowedBook);
        $borrowedBook->save();

        toastr()->success('Return book successfully.');

        return redirect()->route('borrowed.books');
    }
}
