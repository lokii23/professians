<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Question;
use App\Models\User;
use App\Models\Answer;


class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::where('is_active', true)->get();
        return view('dashboard', compact('exams'));
    }
    
    public function admin(Request $request)
    {
        $query = \App\Models\User::query();

        // SEARCH
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('middle_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });

        }

        // FILTER ROLE
        if ($request->role) {

            $query->where('role', $request->role);

        }

        $users = $query->orderBy('id', 'asc')
               ->paginate(10)
               ->withQueryString();

        return view('admin.dashboard', [

            'examCount' => \App\Models\Exam::count(),

            'studentCount' => \App\Models\User::where('role','student')->count(),
            'adminCount' => \App\Models\User::where('role','admin')->count(),

            'resultCount' => \App\Models\Result::count(),

            'users' => $users

        ]);
    }

    public function exams()
    {
        $exams = \App\Models\Exam::latest()->get();
        return view('admin.exams', compact('exams'));
    }

    public function store(Request $request)
    {
        Exam::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'type' => $request->type,
            'passkey' => $request->passkey,
            'user_id' => auth()->id()
        ]);

        return redirect('/admin/exams');
    }

    public function preview($id)
    {
        $exam = Exam::findOrFail($id);
        return view('exam_preview', compact('exam'));
    }
    
    public function checkPasskey(Request $request)
    {
        $exam = Exam::findOrFail($request->exam_id);

        if ($exam->passkey === $request->passkey) {
            return redirect()->route('exam.take', $exam->id);
        }

        return back()->with('error', 'Wrong passkey!');
    }

    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $exam->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'passkey' => $request->passkey,
        ]);

        return back()->with('success', 'Exam updated!');
    }

    public function destroy($id)
    {
        $exam = \App\Models\Exam::findOrFail($id);
        $exam->delete();

        return back()->with('success', 'Exam deleted successfully!');
    }

    public function addQuestions($id)
    {
        $exam = Exam::findOrFail($id);

        $questions = Question::where('exam_id', $id)->get();

        return view('admin.add_questions', compact('exam', 'questions'));
    }
    public function take($id)
    {
        $exam = Exam::findOrFail($id);

        // CHECK IF ALREADY TAKEN
        $alreadyTaken = Result::where('user_id', auth()->id())
            ->where('exam_id', $id)
            ->exists();

        if ($alreadyTaken) {
            return redirect('/dashboard')
                ->with('error', 'You already took this exam.');
        }

        $questions = Question::where('exam_id', $id);

        if ($exam->shuffle_questions) {

            $questions = $questions->inRandomOrder();

        }

        $questions = $questions->get();

        return view('student.take_exam', compact('exam', 'questions'));
    }

    public function submitExam(Request $request)
    {
        $exam = Exam::findOrFail($request->exam_id);

        $questions = Question::where(
            'exam_id',
            $exam->id
        )->get();

        // CHECK IF ALREADY TAKEN
        $alreadyTaken = Result::where(
            'user_id',
            auth()->id()
        )
        ->where('exam_id', $exam->id)
        ->exists();

        if ($alreadyTaken) {

            return back()->with(
                'error',
                'You already took this exam.'
            );
        }

        // CHECK IF ALL QUESTIONS ARE ANSWERED

        foreach ($questions as $question) {

            if ($question->question_type == 'multiple_choice') {

                if (
                    !isset($request->answers[$question->id])
                ) {

                    return back()->with(
                        'error',
                        'Please answer all questions.'
                    );

                }

            } else {

                if (
                    !$request->hasFile("uploads.$question->id")
                ) {

                    return back()->with(
                        'error',
                        'Please upload all required files.'
                    );

                }

            }

        }

        $score = 0;

        // CREATE RESULT
        $result = Result::create([

            'user_id' => auth()->id(),
            'exam_id' => $exam->id,
            'score' => 0

        ]);

        foreach ($questions as $question) {

            /*
            |--------------------------------------------------------------------------
            | MULTIPLE CHOICE
            |--------------------------------------------------------------------------
            */

            if ($question->question_type == 'multiple_choice') {

                $answer = $request->answers[$question->id] ?? null;

                $isCorrect = false;

                if ($answer == $question->correct_answer) {

                    $score++;
                    $isCorrect = true;

                }

                Answer::create([

                    'result_id' => $result->id,

                    'question_id' => $question->id,

                    'student_answer' => $answer,

                    'upload_path' => null,

                    'is_correct' => $isCorrect

                ]);

            }

            /*
            |--------------------------------------------------------------------------
            | FILE UPLOAD
            |--------------------------------------------------------------------------
            */

            else {

                $path = null;

                if ($request->hasFile("uploads.$question->id")) {

                    $path = $request
                        ->file("uploads.$question->id")
                        ->store('student_uploads', 'public');

                }

                Answer::create([

                    'result_id' => $result->id,

                    'question_id' => $question->id,

                    'student_answer' => null,

                    'upload_path' => $path,

                    'is_correct' => false

                ]);

            }

        }


        // UPDATE FINAL SCORE
        $result->update([
            'score' => $score
        ]);

        return redirect()
        ->route('exam.success')
        ->with('score', $score);
    }
    public function results($id)
    {
        $exam = Exam::findOrFail($id);

        $results = Result::where('exam_id', $id)

            ->with('user')

            ->join('users', 'results.user_id', '=', 'users.id')

            ->when(request('sort') == 'asc', function ($query) {

                $query->orderBy('users.last_name', 'asc');

            })

            ->when(request('sort') == 'desc', function ($query) {

                $query->orderBy('users.last_name', 'desc');

            })

            ->select('results.*')

            ->latest()

            ->get();

        return view(
            'admin.results',
            compact('results', 'exam')
        );
    }
    
    public function toggleExam($id)
    {
        $exam = Exam::findOrFail($id);

        $exam->is_active = !$exam->is_active;
        $exam->save();

        return response()->json([
            'success' => true,
            'status' => $exam->is_active
        ]);
    }

    public function liveExams()
    {
        $exams = Exam::where('is_active', true)
            ->latest()
            ->get();

        // ADD TAKEN STATUS
        $exams->map(function ($exam) {

            $exam->taken = Result::where('user_id', auth()->id())
                ->where('exam_id', $exam->id)
                ->exists();

            return $exam;
        });

        return response()->json($exams);
    }

    public function questionsPage($id)
    {
        $exam = Exam::findOrFail($id);

        $questions = Question::where('exam_id', $id)->latest()->get();

        return view('admin.questions', compact('exam', 'questions'));
    }
    public function updateQuestion(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $question->update([

            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,

        ]);

        return back()->with('success', 'Question updated.');
    }
    
    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);

        $question->delete();

        return back()->with('success', 'Question deleted successfully.');
    }

    public function showAddQuestion($id)
    {
        $exam = Exam::findOrFail($id);

        return view('admin.add_questions', compact('exam'));
    }

    public function storeQuestions(Request $request)
    {
        Question::create([
            'exam_id' => $request->exam_id,
            'question' => $request->question,
            'question_type' => $request->question_type,
            'option_a' => $request->question_type == 'multiple_choice'
                    ? $request->option_a
                    : null,

            'option_b' => $request->question_type == 'multiple_choice'
                            ? $request->option_b
                            : null,

            'option_c' => $request->question_type == 'multiple_choice'
                            ? $request->option_c
                            : null,

            'option_d' => $request->question_type == 'multiple_choice'
                            ? $request->option_d
                            : null,

            'correct_answer' => $request->question_type == 'multiple_choice'
                                    ? $request->correct_answer
                                    : null,
        ]);

        return redirect()
        ->route('admin.questions', $request->exam_id)
        ->with('success', 'Question added successfully.');
    }

    public function updateCorrectAnswer(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $question->correct_answer =
            $request->correct_answer;

        $question->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function create()
    {
        $sections = User::select('course')
            ->distinct()
            ->pluck('course');

        return view(
            'admin.create_exam',
            compact('sections')
        );
    }

    public function reviewResult($id)
    {
        $result = Result::with([
            'user',
            'answers.question'
        ])->findOrFail($id);

        return view(
            'admin.review_result',
            compact('result')
        );
    }
    
    public function recheckAnswer(Request $request, $id)
    {
        $answer = Answer::findOrFail($id);

        $answer->is_correct = !$answer->is_correct;

        $answer->save();

        // RECALCULATE SCORE
        $result = Result::find($answer->result_id);

        $newScore = Answer::where('result_id', $result->id)
            ->where('is_correct', true)
            ->count();

        $result->score = $newScore;
        $result->save();

        return back()->with('success', 'Answer rechecked successfully.');
    }

    public function toggleResult($id)
    {
        $exam = Exam::findOrFail($id);

        $exam->show_result =
            !$exam->show_result;

        $exam->save();

        return back()->with(
            'success',
            'Result visibility updated.'
        );
    }

    public function studentResults()
    {
        $results = Result::where('user_id', auth()->id())
            ->whereHas('exam') // Only include results with existing exams
            ->with('exam.questions')
            ->latest()
            ->get();

        return view(
            'student.result',
            compact('results')
        );
    }



    public function viewStudentResult($id)
    {
        $result = Result::with([
            'exam',
            'answers.question'
        ])
        ->where('user_id', auth()->id())
        ->findOrFail($id);

        return view(
            'student.review_score',
            compact('result')
        );
    }

    public function toggleShuffle($id)
    {
        $exam = Exam::findOrFail($id);

        $exam->shuffle_questions =
            !$exam->shuffle_questions;

        $exam->save();

        return back()->with(
            'success',
            'Shuffle mode updated.'
        );
    }

    public function copyExam($id)
    {
        $exam = Exam::findOrFail($id);

        // Create duplicate exam
        $newExam = Exam::create([

            'title' => $exam->title . ' (Copy)',

            'description' => $exam->description,

            'duration' => $exam->duration,

            'type' => $exam->type,

            'passkey' => $exam->passkey,

            'user_id' => auth()->id(),

            'is_active' => false,

            'show_result' => $exam->show_result,

            'shuffle_questions' => $exam->shuffle_questions,

        ]);

        // Copy questions
        $questions = Question::where(
            'exam_id',
            $exam->id
        )->get();

        foreach ($questions as $question) {

            Question::create([

                'exam_id' => $newExam->id,

                'question' => $question->question,
                'question_type' => $question->question_type,

                'option_a' => $question->option_a,

                'option_b' => $question->option_b,

                'option_c' => $question->option_c,

                'option_d' => $question->option_d,

                'correct_answer' => $question->correct_answer,

            ]);
        }

        return redirect()
            ->route('admin.questions', $newExam->id)
            ->with(
                'success',
                'Exam copied successfully. You can now edit it.'
            );
    }

    public function updateScore(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|numeric|min:0'
        ]);

        $result = Result::findOrFail($id);

        $result->score = $request->score;

        $result->save();

        return back()->with(
            'success',
            'Student score updated successfully.'
        );
    }
}
