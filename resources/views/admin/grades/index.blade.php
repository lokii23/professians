@extends('layouts.admin')

@section('content')

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


    {{-- SELECT STUDENT --}}

    {{-- SELECT / SEARCH STUDENT --}}

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <label class="form-label fw-bold">
                Select Student
            </label>

            {{-- SEARCH BAR --}}

            <div class="input-group mb-3">

                <span class="input-group-text">
                    🔍
                </span>

                <input
                    type="text"
                    id="studentSearch"
                    class="form-control"
                    placeholder="Search student by first name or last name...">

            </div>


            {{-- STUDENT DROPDOWN --}}

            <select
                id="studentSelect"
                class="form-select">

                <option value="">
                    -- Select Student --
                </option>

                @foreach($students as $student)

                    <option
                        value="{{ $student->id }}"
                        data-name="{{ strtolower($student->first_name . ' ' . $student->last_name) }}">

                        {{ $student->first_name }} {{ $student->last_name }}

                    </option>

                @endforeach

            </select>

            <small class="text-muted mt-2 d-block">
                Type a student's name above to filter the list.
            </small>

        </div>

    </div>


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
                            id="finalGrade"
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


<script>

const studentSelect =
    document.getElementById('studentSelect');

const gradeSection =
    document.getElementById('gradeSection');

const gradeTable =
    document.getElementById('gradeTable');

const gradeStudentId =
    document.getElementById('gradeStudentId');

const subjectSelect =
    document.getElementById('subjectSelect');


studentSelect.addEventListener(
    'change',
    function () {

        const studentId = this.value;

        if (!studentId) {

            gradeSection.style.display = 'none';

            return;

        }


        gradeStudentId.value = studentId;
            document.getElementById(
                'examScoreStudentId'
            ).value = studentId;
        loadStudentGrades(studentId);

    }
);


function loadStudentGrades(studentId)
{

    fetch(
        `/admin/grades/student/${studentId}`
    )

    .then(response => response.json())

    .then(data => {

        gradeSection.style.display = 'block';


        /*
        |--------------------------------------------------------------------------
        | SUBJECT DROPDOWN
        |--------------------------------------------------------------------------
        */

        


        


        /*
        |--------------------------------------------------------------------------
        | GRADE TABLE
        |--------------------------------------------------------------------------
        */

        gradeTable.innerHTML = '';


        if(data.grades.length === 0)
        {

            gradeTable.innerHTML = `

                <tr>

                    <td
                        colspan="6"
                        class="text-center text-muted">

                        No grades entered yet.

                    </td>

                </tr>

            `;

            return;

        }


        data.grades.forEach(grade => {

            gradeTable.innerHTML += `

                <tr>

                    <td>
                        ${grade.subject.name}
                    </td>

                    <td>
                        ${grade.midterm_grade}
                    </td>

                    <td>
                        ${grade.final_grade}
                    </td>

                    <td>

                        <strong>
                            ${grade.final_rating}
                        </strong>

                    </td>

                    <td>

                        <button
                            type="button"
                            class="btn btn-sm btn-warning me-1"
                            onclick="editGrade(
                                ${grade.id},
                                '${grade.subject.name.replace(/'/g, "\\'")}',
                                ${grade.midterm_grade},
                                ${grade.final_grade}
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

    });

}


/*
|--------------------------------------------------------------------------
| AUTOMATIC FINAL RATING PREVIEW
|--------------------------------------------------------------------------
*/

function calculateRating()
{

    const midterm =
        parseFloat(
            document.getElementById(
                'midtermGrade'
            ).value
        ) || 0;


    const final =
        parseFloat(
            document.getElementById(
                'finalGrade'
            ).value
        ) || 0;


    const rating =
        (midterm + final) / 2;


    document.getElementById(
        'finalRating'
    ).value =
        rating.toFixed(2);

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

const studentSearch =
    document.getElementById('studentSearch');


studentSearch.addEventListener(
    'input',
    function () {

        const searchValue =
            this.value
                .toLowerCase()
                .trim();


        const options =
            studentSelect.querySelectorAll('option');


        options.forEach(function (option) {

            // Always show the default option
            if (!option.value) {

                option.style.display = '';

                return;

            }


            const studentName =
                option.dataset.name.toLowerCase();


            if (
                studentName.includes(searchValue)
            ) {

                option.style.display = '';

            } else {

                option.style.display = 'none';

            }

        });


        /*
        |--------------------------------------------------------------------------
        | RESET SELECTED STUDENT IF IT NO LONGER MATCHES
        |--------------------------------------------------------------------------
        */

        const selectedOption =
            studentSelect.options[
                studentSelect.selectedIndex
            ];


        if (
            selectedOption &&
            selectedOption.value &&
            !selectedOption.dataset.name
                .toLowerCase()
                .includes(searchValue)
        ) {

            studentSelect.value = '';

            gradeSection.style.display = 'none';

        }

    }
);
</script>

@endsection