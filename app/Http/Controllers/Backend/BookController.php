<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowBook;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BookDataTable $dataTable)
    {
        $students = Student::all();
        $grades = Grade::all();
        $subjects = Subject::all();
        return $dataTable->render('admin.library.index', compact('grades', 'subjects', 'students'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_name' => ['required', 'max:255'],
            'grade_id' => ['required', 'exists:grades,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'book_no' => ['required', 'max:255', 'unique:books,book_no'],
            'author' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'qty' => ['required', 'numeric'],
        ]);

        $book = new Book();
        $book->book_no = $request->input('book_no');
        $book->grade_id = $request->input('grade_id');
        $book->subject_id = $request->input('subject_id');
        $book->book_name = $request->input('book_name');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->quantity = $request->input('qty');
        $book->save();

        toastr()->success('Book added successfully!');
        return redirect()->route('library.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::query()->findOrFail($id);
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('admin.library.edit', compact('book', 'grades', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'book_name' => ['required', 'max:255'],
            'grade_id' => ['required', 'exists:grades,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
//            'book_no' => ['required', 'max:255', 'unique:books,book_no'],
            'author' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'qty' => ['required', 'numeric'],
        ]);

    $book = Book::query()->findOrFail($id);
//    $book->book_no = $request->input('book_no');
    $book->grade_id = $request->input('grade_id');
    $book->subject_id = $request->input('subject_id');
    $book->book_name = $request->input('book_name');
    $book->author = $request->input('author');
    $book->publisher = $request->input('publisher');
    $book->quantity = $request->input('qty');
    $book->save();

    toastr()->success('Book details updated successfully!');
    return redirect()->route('library.index');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
   {
       $book = Book::query()->findOrFail($id);

       if (BorrowBook::query()->where(['book_id' => $id, 'status' => 1])->exists()) {
           return response()->json(['status' => 'error', 'message' => 'Book cannot be deleted because it is actively borrowed']);
       }

       $book->delete();

       return response()->json(['status' => 'success', 'message' => 'Book deleted successfully!']);
   }

}
