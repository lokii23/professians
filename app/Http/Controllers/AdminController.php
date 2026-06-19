<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExamResultsExport;


class AdminController extends Controller
{
    
    public function sections()
    {
        $sections = [
            "BSHM3A","BSHM3B","BSTM3A","BSED1A",
            "BSIT1A","BSIT2A","BSIT2B",
            "BSIT3A","BSIT3B","BSIT4A","BSIT4B"
        ];

        return view('admin.sections', compact('sections'));
    }

    public function studentsBySection(Request $request, $course)
    {
        $sort = $request->get('sort', 'asc');

        $students = User::where('course', $course)
            ->orderBy('last_name', $sort)
            ->get();

        return view('admin.students-table', compact(
            'students',
            'course',
            'sort'
        ));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->password) {

            $user->password = Hash::make($request->password);

            $user->save();

        }

        return back()->with('success', 'Password updated successfully.');
    }

    public function disableUser($id)
    {
        $user = User::findOrFail($id);

        $user->status = 'disabled';
        $user->save();

        return back()->with(
            'success',
            'Account disabled successfully.'
        );
    }

    public function enableUser($id)
    {
        $user = User::findOrFail($id);

        $user->status = 'active';
        $user->save();

        return back()->with(
            'success',
            'Account enabled successfully.'
        );
    }

    public function exportResults($id)
    {
        return Excel::download(
            new ExamResultsExport($id),
            'exam-results.xlsx'
        );
    }
}
