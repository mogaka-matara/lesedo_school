<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $activeTerm = Term::getActiveTerm();

        if (!$activeTerm) {
            abort(404, 'No active term found.');
        }
        $totalBooks = Book::all()->count();
        $totalStudents = Student::all()->count();
        $clearedFeeStudents = Student::where('term_status', 'Full Paid')
            ->where('term_id', $activeTerm->id)
            ->count();
        $arrearsStudents = Student::where('term_status', 'Pending')
            ->where('term_id', $activeTerm->id)
            ->count();

        $previousTotalStudents = Student::where('term_id', $activeTerm->id - 1)->count();
        if ($previousTotalStudents > 0) {
            $percentageChange = round((($totalStudents - $previousTotalStudents) / $previousTotalStudents) * 100, 2);
        } else {
            $percentageChange = 0;
        }

        return view('admin.pages.dashboard', compact('totalStudents',
            'totalBooks', 'clearedFeeStudents', 'arrearsStudents', 'percentageChange'));
    }
}
