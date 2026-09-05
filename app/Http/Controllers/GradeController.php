<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\StudentGrade;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ExamScore;

class GradeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - GRADE MANAGEMENT
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $students = User::where('role', 'student')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $subjects = Subject::orderBy('name')
            ->get();

        return view('admin.grades.index', compact(
            'students',
            'subjects'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | GET STUDENT GRADES
    |--------------------------------------------------------------------------
    */

    public function studentGrades($studentId)
    {
        $student = User::findOrFail($studentId);

        $grades = StudentGrade::with('subject')
            ->where('user_id', $student->id)
            ->orderBy('subject_id')
            ->get();

        $subjects = Subject::orderBy('name')
            ->get();

        return response()->json([
            'student' => $student,
            'grades' => $grades,
            'subjects' => $subjects
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE GRADE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'midterm_grade' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'final_grade' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Prevent duplicate subject for the same student
        |--------------------------------------------------------------------------
        */

        $existing = StudentGrade::where(
            'user_id',
            $request->user_id
        )
        ->where(
            'subject_id',
            $request->subject_id
        )
        ->exists();

        if ($existing) {
            return back()->with(
                'error',
                'This student already has a grade for this subject.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | AUTOMATIC FINAL RATING
        |--------------------------------------------------------------------------
        |
        | Current formula:
        |
        | Midterm + Final
        | ---------------- = Final Rating
        |        2
        |
        */

        $finalRating = ($request->midterm_grade !== null && $request->final_grade !== null)
        ? ($request->midterm_grade + $request->final_grade) / 2
        : null;


        StudentGrade::create([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'midterm_grade' => $request->midterm_grade,
            'final_grade' => $request->final_grade,
            'final_rating' => $finalRating,
        ]);


        return back()->with(
            'success',
            'Grade added successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE GRADE
    |--------------------------------------------------------------------------
    */

   public function update(Request $request, $id)
    {
        $request->validate([
            'midterm_grade' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'final_grade' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $grade = StudentGrade::findOrFail($id);

        $finalRating = ($request->midterm_grade !== null && $request->final_grade !== null)
            ? ($request->midterm_grade + $request->final_grade) / 2
            : null;

        $grade->update([
            'midterm_grade' => $request->midterm_grade,
            'final_grade' => $request->final_grade,
            'final_rating' => $finalRating,
        ]);

        return back()->with('success', 'Grade updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE GRADE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $grade = StudentGrade::findOrFail($id);

        $grade->delete();

        return back()->with(
            'success',
            'Grade deleted successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SUBJECT MANAGEMENT
    |--------------------------------------------------------------------------
    */

    public function storeSubject(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:subjects,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Subject::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return back()->with(
            'success',
            'Subject added successfully.'
        );
    }


    public function destroySubject($id)
    {
        $subject = Subject::findOrFail($id);

        $subject->delete();

        return back()->with(
            'success',
            'Subject deleted successfully.'
        );
    }



    /*
    |--------------------------------------------------------------------------
    | STUDENT - MY GRADES
    |--------------------------------------------------------------------------
    */

    public function studentIndex()
    {
        $grades = StudentGrade::with('subject')
            ->where('user_id', auth()->id())
            ->orderBy('subject_id')
            ->get();

        return view('student.grades.index', compact('grades'));
    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT - SUBJECT GRADE DETAILS
    |--------------------------------------------------------------------------
    */

    public function studentSubject($subjectId)
    {
        $grade = StudentGrade::with('subject')
            ->where('user_id', auth()->id())
            ->where('subject_id', $subjectId)
            ->firstOrFail();

        $examScores = ExamScore::where('user_id', auth()->id())
            ->where('subject_id', $subjectId)
            ->orderBy('exam_type')
            ->orderBy('created_at')
            ->get();

        return view(
            'student.grades.subject',
            compact(
                'grade',
                'examScores'
            )
        );
    }

    public function storeExamScore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_name' => 'required|string|max:255',
            'exam_type' => 'required|in:midterm,final,quiz,other',
            'score' => 'required|numeric|min:0',
            'total_score' => 'required|numeric|min:0|gte:score',
        ]);

        ExamScore::create([
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'exam_name' => $request->exam_name,
            'exam_type' => $request->exam_type,
            'score' => $request->score,
            'total_score' => $request->total_score,
        ]);

        return back()->with(
            'success',
            'Examination score added successfully.'
        );
    }

    public function studentExamScores($studentId)
    {
        $scores = ExamScore::with('subject')
            ->where('user_id', $studentId)
            ->orderBy('subject_id')
            ->orderBy('exam_type')
            ->get();

        return response()->json([
            'scores' => $scores,
        ]);
    }

    public function destroyExamScore($id)
    {
        $score = ExamScore::findOrFail($id);

        $score->delete();

        return back()->with(
            'success',
            'Examination score deleted successfully.'
        );
    }

    public function updateExamScore(Request $request, $id)
    {
        $request->validate([
            'exam_name' => 'required|string|max:255',
            'exam_type' => 'required|in:midterm,final,quiz,other',
            'score' => [
                'required',
                'numeric',
                'min:0',
            ],
            'total_score' => [
                'required',
                'numeric',
                'min:1',
                'gte:score',
            ],
        ]);

        $examScore = ExamScore::findOrFail($id);

        $examScore->update([
            'exam_name' => $request->exam_name,
            'exam_type' => $request->exam_type,
            'score' => $request->score,
            'total_score' => $request->total_score,
        ]);

        return back()->with(
            'success',
            'Examination score updated successfully.'
        );
    }

}