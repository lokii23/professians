@extends('layouts.admin')

@section('content')
<style>

.student-search-results {

    position: absolute;

    top: 100%;

    left: 0;

    right: 0;

    z-index: 1050;

    margin-top: 6px;

    background: #ffffff;

    border: 1px solid #dee2e6;

    border-radius: 12px;

    box-shadow:
        0 10px 30px rgba(0,0,0,.15);

    overflow: hidden;

    display: none;

    max-height: 320px;

    overflow-y: auto;

}


.student-search-item {

    width: 100%;

    border: 0;

    background: #ffffff;

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 14px 16px;

    text-align: left;

    transition: .2s;

    border-bottom: 1px solid #f0f0f0;

}


.student-search-item:last-child {

    border-bottom: 0;

}


.student-search-item:hover {

    background: #f1f5ff;

}


.student-search-icon {

    width: 42px;

    height: 42px;

    border-radius: 50%;

    background: #e7f0ff;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 20px;

    flex-shrink: 0;

}


.student-search-info {

    display: flex;

    flex-direction: column;

    flex-grow: 1;

}


.student-search-info strong {

    color: #212529;

    font-size: 15px;

}


.student-search-info small {

    color: #6c757d;

    margin-top: 2px;

}


.student-search-arrow {

    color: #0d6efd;

    font-size: 20px;

    font-weight: bold;

}


.student-no-results {

    padding: 20px;

    text-align: center;

    color: #6c757d;

}


.selected-student {

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 12px 15px;

    background: #f0f7ff;

    border: 1px solid #b8d7ff;

    border-radius: 12px;

}


.selected-student-icon {

    width: 42px;

    height: 42px;

    border-radius: 50%;

    background: #dbeafe;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 20px;

}


.selected-student small {

    display: block;

    color: #6c757d;

    font-size: 12px;

}


.selected-student #selectedStudentName {

    color: #1e3a8a;

}
.exam-summary-card {
    background: linear-gradient(
        135deg,
        #f0f9ff,
        #e0f2fe
    );

    border: 1px solid #bae6fd;

    border-radius: 14px;

    padding: 18px;

    height: 100%;

    transition: .2s;
}

.exam-summary-card:hover {
    transform: translateY(-2px);

    box-shadow:
        0 8px 20px rgba(0,0,0,.08);
}

.exam-summary-card small {
    color: #64748b;

    font-size: 12px;

    text-transform: uppercase;

    font-weight: 600;
}

.exam-summary-card h3 {
    margin: 5px 0 0;

    color: #0369a1;

    font-weight: 700;
}

.exam-score-percent {
    font-weight: 700;

    color: #0369a1;
}

.exam-score-badge {
    font-size: 11px;

    padding: 5px 8px;

    border-radius: 20px;
}

</style>
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Grade Management
            </h2>

            <p class="text-muted mb-0">
                Manage student Midterm, Final, and Final Rating.
            </p>
        </div>

        <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#subjectModal">

            + Add Subject

        </button>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR MESSAGE --}}

    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    {{-- SEARCH STUDENT --}}

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <label class="form-label fw-bold mb-2">
                Search Student
            </label>

            <div class="position-relative">

                <div class="input-group">

                    <span class="input-group-text">
                        🔍
                    </span>

                    <input
                        type="text"
                        id="studentSearch"
                        class="form-control"
                        autocomplete="off"
                        placeholder="Search student by name...">

                </div>


                {{-- SEARCH RESULTS --}}

                <div
                    id="studentSearchResults"
                    class="student-search-results">

                </div>

            </div>


            {{-- SELECTED STUDENT --}}

            <div
                id="selectedStudent"
                class="selected-student mt-3"
                style="display:none;">

                <div class="selected-student-icon">
                    👤
                </div>

                <div class="flex-grow-1">

                    <small>
                        Selected Student
                    </small>

                    <div
                        id="selectedStudentName"
                        class="fw-bold">
                    </div>

                </div>

                <button
                    type="button"
                    id="clearStudent"
                    class="btn btn-sm btn-outline-danger">

                    Change

                </button>

            </div>

        </div>

    </div>


    {{-- HIDDEN STUDENT ID --}}

    <input
        type="hidden"
        id="selectedStudentId">


    {{-- GRADES --}}

    <div id="gradeSection" style="display:none;">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    Student Grades
                </h5>

            </div>

            <div class="card-body">

                <div class="d-flex gap-2 mb-3">

                    <button
                        id="addGradeButton"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#gradeModal">

                        + Add Grade

                    </button>

                    <button
                        id="addExamScoreButton"
                        class="btn btn-info"
                        data-bs-toggle="modal"
                        data-bs-target="#examScoreModal">

                        📝 Add Examination Score

                    </button>

                </div>


                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead>

                            <tr>

                                <th>Subject</th>
                                <th>Midterm</th>
                                <th>Final</th>
                                <th>Final Rating</th>
                                <th>Examination Scores</th>
                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody id="gradeTable">

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ADD GRADE MODAL --}}

<div
    class="modal fade"
    id="gradeModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="POST"
                action="{{ route('admin.grades.store') }}">

                @csrf

                <input
                    type="hidden"
                    name="user_id"
                    id="gradeStudentId">


                <div class="modal-header">

                    <h5 class="modal-title">
                        Add Grade
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Subject
                        </label>

                        <select
                            name="subject_id"
                            id="subjectSelect"
                            class="form-select"
                            required>

                            <option value="">
                                -- Select Subject --
                            </option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}">
                                    {{ $subject->code }} - {{ $subject->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Midterm Grade
                        </label>

                        <input
                            type="number"
                            name="midterm_grade"
                            id="midtermGrade"
                            class="form-control"loadStudentGrades
                            min="0"
                            max="100"
                            step="0.01"
                            >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Final Grade
                        </label>

                        <input
                            type="number"
                            name="final_grade"
                            id="finalGrade"
                            class="form-control"
                            min="0"
                            max="100"
                            step="0.01"
                            >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Final Rating
                        </label>

                        <input
                            type="text"
                            id="finalRating"
                            class="form-control"
                            readonly>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Save Grade

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ADD SUBJECT MODAL --}}

<div
    class="modal fade"
    id="subjectModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="POST"
                action="{{ route('admin.subjects.store') }}">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Add Subject
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Subject Code
                        </label>

                        <input
                            type="text"
                            name="code"
                            class="form-control"
                            placeholder="IT101"
                            required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Subject Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Programming 1"
                            required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control">
                        </textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Add Subject

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- EDIT GRADE MODAL --}}

<div class="modal fade" id="editGradeModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="POST"
                id="editGradeForm">

                @csrf
                @method('PUT')

                <div class="modal-header">

                    <h5 class="modal-title">
                        Edit Grade
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Subject
                        </label>

                        <input
                            type="text"
                            id="editSubject"
                            class="form-control"
                            readonly>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Midterm Grade
                        </label>

                        <input
                            type="number"
                            name="midterm_grade"
                            id="editMidterm"
                            class="form-control"
                            min="0"
                            max="100"
                            step="0.01"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Final Grade
                        </label>

                        <input
                            type="number"
                            name="final_grade"
                            id="editFinal"
                            class="form-control"
                            min="0"
                            max="100"
                            step="0.01"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Final Rating
                        </label>

                        <input
                            type="text"
                            id="editFinalRating"
                            class="form-control"
                            readonly>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Update Grade

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- DELETE GRADE MODAL --}}

<div class="modal fade" id="deleteGradeModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form
                method="POST"
                id="deleteGradeForm">

                @csrf
                @method('DELETE')

                <div class="modal-header">

                    <h5 class="modal-title text-danger">
                        Delete Grade
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <p class="mb-0">

                        Are you sure you want to delete this
                        grade?

                    </p>

                    <small class="text-muted">

                        This action cannot be undone.

                    </small>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn btn-danger">

                        Yes, Delete

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- ADD EXAMINATION SCORE MODAL --}}

<div
    class="modal fade"
    id="examScoreModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="POST"
                action="{{ route('admin.grades.exam-score.store') }}">

                @csrf

                <input
                    type="hidden"
                    name="user_id"
                    id="examScoreStudentId">


                <div class="modal-header">

                    <h5 class="modal-title">
                        📝 Add Examination Score
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <div class="modal-body">

                    {{-- SUBJECT --}}

                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Subject
                        </label>

                        <select
                            name="subject_id"
                            class="form-select"
                            required>

                            <option value="">
                                -- Select Subject --
                            </option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}">

                                    {{ $subject->code }}
                                    -
                                    {{ $subject->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- EXAM NAME --}}

                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Examination Name
                        </label>

                        <input
                            type="text"
                            name="exam_name"
                            class="form-control"
                            placeholder="Midterm Examination"
                            value="Midterm Examination"
                            required>

                    </div>


                    {{-- EXAM TYPE --}}

                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Examination Type
                        </label>

                        <select
                            name="exam_type"
                            class="form-select"
                            required>

                            <option value="midterm">
                                Midterm Examination
                            </option>

                            <option value="final">
                                Final Examination
                            </option>

                            <option value="quiz">
                                Quiz
                            </option>

                            <option value="other">
                                Other
                            </option>

                        </select>

                    </div>


                    {{-- SCORE --}}

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                Score
                            </label>

                            <input
                                type="number"
                                name="score"
                                class="form-control"
                                min="0"
                                step="0.01"
                                placeholder="45"
                                required>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                Total Score
                            </label>

                            <input
                                type="number"
                                name="total_score"
                                class="form-control"
                                min="1"
                                step="0.01"
                                placeholder="50"
                                required>

                        </div>

                    </div>


                    <div class="alert alert-info mb-0">

                        Example:
                        <strong>45 / 50 = 90%</strong>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn btn-info">

                        Save Examination Score

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- VIEW EXAMINATION SCORES MODAL --}}

<div class="modal fade" id="viewExamScoresModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-info text-white">

                <div>
                    <h5 class="modal-title mb-1">
                        📝 Examination Scores
                    </h5>

                    <small id="examScoreSubjectName">
                        Subject
                    </small>
                </div>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <div class="modal-body">

                {{-- SUMMARY --}}

                <div class="row g-3 mb-4">

                    <div class="col-md-4">

                        <div class="exam-summary-card">

                            <small>
                                Total Examinations
                            </small>

                            <h3 id="totalExams">
                                0
                            </h3>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="exam-summary-card">

                            <small>
                                Average Score
                            </small>

                            <h3 id="averageExamScore">
                                0%
                            </h3>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="exam-summary-card">

                            <small>
                                Highest Score
                            </small>

                            <h3 id="highestExamScore">
                                0%
                            </h3>

                        </div>

                    </div>

                </div>


                {{-- SCORES TABLE --}}

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>
                                    Examination
                                </th>

                                <th>
                                    Type
                                </th>

                                <th class="text-center">
                                    Score
                                </th>

                                <th class="text-center">
                                    Percentage
                                </th>

                                <th class="text-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody id="examScoresTable">

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center text-muted py-4">

                                    Loading...

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Close

                </button>

                <button
                    type="button"
                    class="btn btn-info text-white"
                    onclick="openAddExamScoreFromView()">

                    + Add Examination

                </button>

            </div>

        </div>

    </div>

</div>
{{-- EDIT EXAMINATION SCORE MODAL --}}

<div class="modal fade" id="editExamScoreModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="POST" id="editExamScoreForm">

                @csrf
                @method('PUT')

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">
                        ✏️ Edit Examination Score
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <div class="modal-body">

                    {{-- EXAMINATION NAME --}}

                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Examination Name
                        </label>

                        <input
                            type="text"
                            name="exam_name"
                            id="editExamName"
                            class="form-control"
                            required>

                    </div>


                    {{-- EXAMINATION TYPE --}}

                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            Examination Type
                        </label>

                        <select
                            name="exam_type"
                            id="editExamType"
                            class="form-select"
                            required>

                            <option value="midterm">
                                Midterm Examination
                            </option>

                            <option value="final">
                                Final Examination
                            </option>

                            <option value="quiz">
                                Quiz
                            </option>

                            <option value="other">
                                Other
                            </option>

                        </select>

                    </div>


                    {{-- SCORE --}}

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                Score
                            </label>

                            <input
                                type="number"
                                name="score"
                                id="editExamScore"
                                class="form-control"
                                min="0"
                                step="0.01"
                                required>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">
                                Total Score
                            </label>

                            <input
                                type="number"
                                name="total_score"
                                id="editExamTotalScore"
                                class="form-control"
                                min="1"
                                step="0.01"
                                required>

                        </div>

                    </div>


                    {{-- LIVE PERCENTAGE --}}

                    <div
                        class="alert alert-info"
                        id="editExamPercentage">

                        Score percentage will appear here.

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        Update Score

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<div class="modal fade" id="deleteExamScoreModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">🗑️ Delete Examination Score</h5>
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="mb-2">
                    Are you sure you want to delete this examination score?
                </p>

                <div class="alert alert-warning mb-0">
                    <strong id="deleteExamScoreName"></strong>
                    <br>
                    <small>
                        This action cannot be undone.
                    </small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <form method="POST" id="deleteExamScoreForm">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        🗑️ Delete Score
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
    
<script>

const gradeSection =
    document.getElementById('gradeSection');

const gradeTable =
    document.getElementById('gradeTable');

const gradeStudentId =
    document.getElementById('gradeStudentId');

const subjectSelect =
    document.getElementById('subjectSelect');

const students = @json(
    $students->map(function ($student) {

        return [
            'id' => $student->id,
            'name' => $student->first_name . ' ' . $student->last_name,
        ];

    })
);


function loadStudentGrades(studentId)
{
    fetch(`/admin/grades/student/${studentId}`)
        .then(response => response.json())
        .then(data => {

            gradeSection.style.display = 'block';

            gradeTable.innerHTML = '';

            if (data.grades.length === 0)
            {
                gradeTable.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No grades entered yet.
                        </td>
                    </tr>
                `;

                return;
            }

            data.grades.forEach(grade => {

                /*
                |--------------------------------------------------------------------------
                | MIDTERM
                |--------------------------------------------------------------------------
                */

                const midterm =
                    grade.midterm_grade !== null
                        ? parseFloat(grade.midterm_grade).toFixed(2)
                        : '<span class="text-muted">—</span>';


                /*
                |--------------------------------------------------------------------------
                | FINAL
                |--------------------------------------------------------------------------
                */

                const final =
                    grade.final_grade !== null
                        ? parseFloat(grade.final_grade).toFixed(2)
                        : '<span class="text-muted">—</span>';


                /*
                |--------------------------------------------------------------------------
                | FINAL RATING
                |--------------------------------------------------------------------------
                */

                const finalRating =
                    grade.final_rating !== null
                        ? `<strong>${parseFloat(grade.final_rating).toFixed(2)}</strong>`
                        : '<span class="text-muted">—</span>';


                /*
                |--------------------------------------------------------------------------
                | ADD ROW
                |--------------------------------------------------------------------------
                */

                gradeTable.innerHTML += `
                    <tr>

                        <!-- SUBJECT -->
                        <td>
                            <strong>
                                ${grade.subject.code}
                            </strong>
                            <br>
                            <small class="text-muted">
                                ${grade.subject.name}
                            </small>
                        </td>


                        <!-- MIDTERM -->
                        <td>
                            ${midterm}
                        </td>


                        <!-- FINAL -->
                        <td>
                            ${final}
                        </td>


                        <!-- FINAL RATING -->
                        <td>
                            ${finalRating}
                        </td>


                        <!-- EXAMINATION SCORES -->
                        <td>

                            <button
                                type="button"
                                class="btn btn-sm btn-info"
                                onclick="viewExamScores(
                                    ${studentId},
                                    ${grade.subject_id},
                                    '${grade.subject.name.replace(/'/g, "\\'")}'
                                )">

                                📝 View Scores

                            </button>

                        </td>


                        <!-- ACTIONS -->
                        <td>

                            <button
                                type="button"
                                class="btn btn-sm btn-warning me-1"
                                onclick="editGrade(
                                    ${grade.id},
                                    '${grade.subject.name.replace(/'/g, "\\'")}',
                                    ${grade.midterm_grade ?? 'null'},
                                    ${grade.final_grade ?? 'null'}
                                )">

                                Edit

                            </button>


                            <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                onclick="deleteGrade(${grade.id})">

                                Delete

                            </button>

                        </td>

                    </tr>
                `;

            });

        })
        .catch(error => {

            console.error('Error loading grades:', error);

            gradeTable.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-danger py-4">
                        Unable to load student grades.
                    </td>
                </tr>
            `;

        });
}


/*
|--------------------------------------------------------------------------
| AUTOMATIC FINAL RATING PREVIEW
|--------------------------------------------------------------------------
*/

function calculateRating()
{

    const midtermValue = document.getElementById('midtermGrade').value;
    const finalValue = document.getElementById('finalGrade').value;

    const finalRating = document.getElementById('finalRating');

    if (midtermValue === '' || finalValue === '') {
        finalRating.value = '';
        return;
    }

    const midterm = parseFloat(midtermValue);
    const final = parseFloat(finalValue);

    finalRating.value = ((midterm + final) / 2).toFixed(2);

}


document.getElementById(
    'midtermGrade'
).addEventListener(
    'input',
    calculateRating
);


document.getElementById(
    'finalGrade'
).addEventListener(
    'input',
    calculateRating
);


function editGrade(
    id,
    subject,
    midterm,
    final
) {

    document.getElementById(
        'editSubject'
    ).value = subject;

    document.getElementById(
        'editMidterm'
    ).value = midterm;

    document.getElementById(
        'editFinal'
    ).value = final;

    calculateEditRating();


    document.getElementById(
        'editGradeForm'
    ).action =
        `/admin/grades/${id}`;


    const modal =
        new bootstrap.Modal(
            document.getElementById(
                'editGradeModal'
            )
        );

    modal.show();
}

function calculateEditRating()
{

    const midterm =
        parseFloat(
            document.getElementById(
                'editMidterm'
            ).value
        ) || 0;

    const final =
        parseFloat(
            document.getElementById(
                'editFinal'
            ).value
        ) || 0;

    const rating =
        (midterm + final) / 2;

    document.getElementById(
        'editFinalRating'
    ).value =
        rating.toFixed(2);
}
document.getElementById(
    'editMidterm'
).addEventListener(
    'input',
    calculateEditRating
);

document.getElementById(
    'editFinal'
).addEventListener(
    'input',
    calculateEditRating
);

function deleteGrade(id)
{

    document.getElementById(
        'deleteGradeForm'
    ).action =
        `/admin/grades/${id}`;


    const modal =
        new bootstrap.Modal(
            document.getElementById(
                'deleteGradeModal'
            )
        );

    modal.show();
}

/*
|--------------------------------------------------------------------------
| SEARCH STUDENTS
|--------------------------------------------------------------------------
*/

studentSearch.addEventListener(
    'input',
    function () {

        const search =
            this.value
                .toLowerCase()
                .trim();


        studentSearchResults.innerHTML = '';


        if (!search) {

            studentSearchResults.style.display = 'none';

            return;

        }


        const matches =
            students.filter(function (student) {

                return student.name
                    .toLowerCase()
                    .includes(search);

            });


        if (matches.length === 0) {

            studentSearchResults.innerHTML = `

                <div class="student-no-results">

                    🔍 No student found.

                </div>

            `;

            studentSearchResults.style.display = 'block';

            return;

        }


        matches.forEach(function (student) {

            const result =
                document.createElement('button');


            result.type = 'button';

            result.className =
                'student-search-item';


            result.innerHTML = `

                <div class="student-search-icon">

                    👤

                </div>

                <div class="student-search-info">

                    <strong>
                        ${student.name}
                    </strong>

                    <small>
                        Click to manage grades
                    </small>

                </div>

                <div class="student-search-arrow">

                    →

                </div>

            `;


            result.addEventListener(
                'click',
                function () {

                    selectStudent(student);

                }
            );


            studentSearchResults.appendChild(result);

        });


        studentSearchResults.style.display = 'block';

    }
);

function selectStudent(student)
{
    /*
    |--------------------------------------------------------------------------
    | SET STUDENT ID
    |--------------------------------------------------------------------------
    */

    selectedStudentId.value =
        student.id;

    gradeStudentId.value =
        student.id;

    examScoreStudentId.value =
        student.id;


    /*
    |--------------------------------------------------------------------------
    | DISPLAY SELECTED STUDENT
    |--------------------------------------------------------------------------
    */

    selectedStudentName.textContent =
        student.name;

    selectedStudent.style.display =
        'flex';


    /*
    |--------------------------------------------------------------------------
    | HIDE SEARCH RESULTS
    |--------------------------------------------------------------------------
    */

    studentSearchResults.innerHTML = '';

    studentSearchResults.style.display =
        'none';


    /*
    |--------------------------------------------------------------------------
    | CLEAR SEARCH INPUT
    |--------------------------------------------------------------------------
    */

    studentSearch.value =
        student.name;


    /*
    |--------------------------------------------------------------------------
    | LOAD GRADES
    |--------------------------------------------------------------------------
    */

    loadStudentGrades(student.id);
}

clearStudent.addEventListener(
    'click',
    function () {

        selectedStudentId.value = '';

        gradeStudentId.value = '';

        examScoreStudentId.value = '';


        selectedStudent.style.display =
            'none';


        studentSearch.value = '';

        studentSearch.focus();


        gradeSection.style.display =
            'none';

    }
);
document.getElementById('midtermGrade').addEventListener('input', calculateFinalRating);
document.getElementById('finalGrade').addEventListener('input', calculateFinalRating);

function viewExamScores(
    studentId,
    subjectId,
    subjectName
)
{
    const modalElement =
        document.getElementById('viewExamScoresModal');

    const modal =
        new bootstrap.Modal(modalElement);


    /*
    |--------------------------------------------------------------------------
    | SET SUBJECT NAME
    |--------------------------------------------------------------------------
    */

    document.getElementById(
        'examScoreSubjectName'
    ).textContent = subjectName;


    /*
    |--------------------------------------------------------------------------
    | RESET SUMMARY
    |--------------------------------------------------------------------------
    */

    document.getElementById(
        'totalExams'
    ).textContent = '0';

    document.getElementById(
        'averageExamScore'
    ).textContent = '0%';

    document.getElementById(
        'highestExamScore'
    ).textContent = '0%';


    /*
    |--------------------------------------------------------------------------
    | LOADING
    |--------------------------------------------------------------------------
    */

    document.getElementById(
        'examScoresTable'
    ).innerHTML = `

        <tr>

            <td
                colspan="5"
                class="text-center py-4">

                <div
                    class="spinner-border text-info"
                    role="status">
                </div>

                <div class="mt-2 text-muted">

                    Loading examination scores...

                </div>

            </td>

        </tr>

    `;


    modal.show();


    /*
    |--------------------------------------------------------------------------
    | FETCH SCORES
    |--------------------------------------------------------------------------
    */

    fetch(
        `/admin/grades/student/${studentId}/exam-scores`
    )

    .then(response => {

        if (!response.ok) {
            throw new Error(
                'Unable to load examination scores.'
            );
        }

        return response.json();

    })

    .then(data => {

        const scores =
            data.scores.filter(score =>
                Number(score.subject_id) === Number(subjectId)
            );


        /*
        |--------------------------------------------------------------------------
        | NO SCORES
        |--------------------------------------------------------------------------
        */

        if (scores.length === 0)
        {

            document.getElementById(
                'examScoresTable'
            ).innerHTML = `

                <tr>

                    <td
                        colspan="5"
                        class="text-center py-5">

                        <div style="font-size:40px;">
                            📝
                        </div>

                        <h6 class="mt-3">
                            No Examination Scores
                        </h6>

                        <p class="text-muted mb-3">

                            No examination scores have been
                            posted for this subject yet.

                        </p>

                        <button
                            type="button"
                            class="btn btn-info text-white"
                            onclick="openAddExamScoreFromView()">

                            + Add Examination Score

                        </button>

                    </td>

                </tr>

            `;

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | CALCULATE SUMMARY
        |--------------------------------------------------------------------------
        */

        const percentages =
            scores.map(score => {

                return (
                    Number(score.score) /
                    Number(score.total_score)
                ) * 100;

            });


        const average =
            percentages.reduce(
                (sum, value) => sum + value,
                0
            ) / percentages.length;


        const highest =
            Math.max(...percentages);


        document.getElementById(
            'totalExams'
        ).textContent =
            scores.length;


        document.getElementById(
            'averageExamScore'
        ).textContent =
            average.toFixed(2) + '%';


        document.getElementById(
            'highestExamScore'
        ).textContent =
            highest.toFixed(2) + '%';


        /*
        |--------------------------------------------------------------------------
        | BUILD TABLE
        |--------------------------------------------------------------------------
        */

        let html = '';


        scores.forEach(score => {

            const percentage =
                (
                    Number(score.score) /
                    Number(score.total_score)
                ) * 100;


            let badgeClass =
                'bg-secondary';


            if (percentage >= 90)
            {
                badgeClass = 'bg-success';
            }
            else if (percentage >= 75)
            {
                badgeClass = 'bg-primary';
            }
            else if (percentage >= 60)
            {
                badgeClass = 'bg-warning text-dark';
            }
            else
            {
                badgeClass = 'bg-danger';
            }


            let typeLabel =
                score.exam_type;


            if (score.exam_type === 'midterm')
            {
                typeLabel =
                    'Midterm';
            }
            else if (score.exam_type === 'final')
            {
                typeLabel =
                    'Final';
            }
            else if (score.exam_type === 'quiz')
            {
                typeLabel =
                    'Quiz';
            }
            else
            {
                typeLabel =
                    'Other';
            }


            html += `

                <tr>

                    <td>

                        <strong>
                            ${score.exam_name}
                        </strong>

                    </td>


                    <td>

                        <span
                            class="badge ${badgeClass} exam-score-badge">

                            ${typeLabel}

                        </span>

                    </td>


                    <td class="text-center">

                        <strong>
                            ${Number(score.score).toFixed(2)}
                        </strong>

                        <span class="text-muted">
                            /
                            ${Number(score.total_score).toFixed(2)}
                        </span>

                    </td>


                    <td class="text-center">

                        <span class="exam-score-percent">

                            ${percentage.toFixed(2)}%

                        </span>

                    </td>


                    <td class="text-center">

                        <button
                            type="button"
                            class="btn btn-sm btn-warning me-1"
                            onclick="editExamScore(${score.id})">

                            Edit

                        </button>


                        <button
                            type="button"
                            class="btn btn-sm btn-danger"
                            onclick="deleteExamScore(${score.id})">

                            Delete

                        </button>

                    </td>

                </tr>

            `;

        });


        document.getElementById(
            'examScoresTable'
        ).innerHTML = html;

    })

    .catch(error => {

        console.error(error);


        document.getElementById(
            'examScoresTable'
        ).innerHTML = `

            <tr>

                <td
                    colspan="5"
                    class="text-center text-danger py-4">

                    ❌ Unable to load examination scores.

                </td>

            </tr>

        `;

    });
}
function openAddExamScoreFromView()
{
    const viewModalElement =
        document.getElementById(
            'viewExamScoresModal'
        );

    const viewModal =
        bootstrap.Modal.getInstance(
            viewModalElement
        );


    if (viewModal)
    {
        viewModal.hide();
    }


    setTimeout(() => {

        const examModal =
            new bootstrap.Modal(
                document.getElementById(
                    'examScoreModal'
                )
            );

        examModal.show();

    }, 300);
}

function editExamScore(scoreId)
{
    /*
    |--------------------------------------------------------------------------
    | FIND SCORE
    |--------------------------------------------------------------------------
    */

    fetch(`/admin/grades/student/${selectedStudentId.value}/exam-scores`)
        .then(response => response.json())
        .then(data => {

            const score = data.scores.find(
                item => Number(item.id) === Number(scoreId)
            );


            if (!score)
            {
                alert('Examination score not found.');
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | FILL FORM
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                'editExamName'
            ).value = score.exam_name;


            document.getElementById(
                'editExamType'
            ).value = score.exam_type;


            document.getElementById(
                'editExamScore'
            ).value = score.score;


            document.getElementById(
                'editExamTotalScore'
            ).value = score.total_score;


            /*
            |--------------------------------------------------------------------------
            | SET FORM ACTION
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                'editExamScoreForm'
            ).action =
                `/admin/grades/exam-score/${score.id}`;


            /*
            |--------------------------------------------------------------------------
            | CALCULATE PERCENTAGE
            |--------------------------------------------------------------------------
            */

            calculateEditExamPercentage();


            /*
            |--------------------------------------------------------------------------
            | OPEN MODAL
            |--------------------------------------------------------------------------
            */

            const modal =
                new bootstrap.Modal(
                    document.getElementById(
                        'editExamScoreModal'
                    )
                );

            modal.show();

        })
        .catch(error => {

            console.error(
                'Error loading examination score:',
                error
            );

        });
}

function calculateEditExamPercentage()
{
    const score =
        parseFloat(
            document.getElementById(
                'editExamScore'
            ).value
        );

    const total =
        parseFloat(
            document.getElementById(
                'editExamTotalScore'
            ).value
        );

    const display =
        document.getElementById(
            'editExamPercentage'
        );


    if (
        isNaN(score) ||
        isNaN(total) ||
        total <= 0
    )
    {
        display.innerHTML =
            'Score percentage will appear here.';

        return;
    }


    const percentage =
        (score / total) * 100;


    display.innerHTML = `
        Score:
        <strong>
            ${score} / ${total}
        </strong>

        &nbsp; = &nbsp;

        <strong>
            ${percentage.toFixed(2)}%
        </strong>
    `;
}
function deleteExamScore(scoreId)
{
    fetch(`/admin/grades/student/${selectedStudentId.value}/exam-scores`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Unable to load examination scores.');
            }

            return response.json();
        })
        .then(data => {

            const score = data.scores.find(
                item => Number(item.id) === Number(scoreId)
            );

            if (!score) {
                alert('Examination score not found.');
                return;
            }

            // Show examination name in confirmation modal
            document.getElementById('deleteExamScoreName').textContent =
                score.exam_name;

            // Set DELETE form action
            document.getElementById('deleteExamScoreForm').action =
                `/admin/grades/exam-score/${score.id}`;

            // Show confirmation modal
            const modal = new bootstrap.Modal(
                document.getElementById('deleteExamScoreModal')
            );

            modal.show();
        })
        .catch(error => {
            console.error('Error loading examination score:', error);

            alert('Unable to load examination score.');
        });
}



</script>

@endsection