<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;


class AdminController extends Controller
{
    
    public function sections()
    {
        $sections = [
            "BSHM3A","BSHM3B","BSTM3A","BSED1A",
            "BSIT1A","BSIT1B","BSIT2A","BSIT2B",
            "BSIT3A","BSIT3B","BSIT4A","BSIT4B"
        ];

        return view('admin.sections', compact('sections'));
    }

    public function studentsBySection($course)
    {
        $students = User::where('course', $course)->get();

        return view('admin.students-table', compact('students', 'course'));
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
}
