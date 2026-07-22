@extends('layouts.admin')

@section('content')
<div class="mb-3">

    <a href="{{ url('/admin/exams') }}" 
       class="btn btn-secondary">

        ← Back to Exams

    </a>

</div>
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4>📚 {{ $exam->title }}</h4>
        <p class="text-muted">
            Manage Questions
        </p>
    </div>

    <a href="{{ route('admin.show-add-question', $exam->id) }}"
       class="btn btn-primary">

       + Add Question

    </a>

</div>


<div class="row g-1">
<form action="{{ route('admin.exam.shuffle', $exam->id) }}"
      method="POST">

    @csrf

    <button class="btn btn-dark rounded-pill">

        🔀 Shuffle Questions:
        {{ $exam->shuffle_questions ? 'ON' : 'OFF' }}

    </button>

</form>
@foreach($questions as $question)
<div class="col-md-8 offset-md-2 mb-3">

    <div class="card shadow-sm border-0 question-card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">

                <div class="w-75">

                    <h5 class="fw-bold mb-2">
                        {{ $question->question }}
                    </h5>

                    @if($question->question_type == 'multiple_choice')

                        <span class="badge bg-primary">

                            📝 Multiple Choice

                        </span>

                    @else

                        <span class="badge bg-warning text-dark">

                            📷 File Upload

                        </span>

                    @endif

                </div>

                <div class="d-flex gap-2">

                    <!-- EDIT BUTTON -->
                    <button
                        class="btn btn-sm btn-warning editBtn"

                        data-id="{{ $question->id }}"
                        data-type="{{ $question->question_type }}"
                        data-question="{{ $question->question }}"
                        data-a="{{ $question->option_a }}"
                        data-b="{{ $question->option_b }}"
                        data-c="{{ $question->option_c }}"
                        data-d="{{ $question->option_d }}"
                    >

                        ✏ Edit

                    </button>

                    <!-- DELETE BUTTON -->
                    <button
                        class="btn btn-sm btn-danger deleteBtn"
                        data-id="{{ $question->id }}"
                    >

                        🗑 Delete

                    </button>

                </div>

            </div>

            @if($question->question_type == 'multiple_choice')

                <div class="mb-3">

                    <!-- A -->
                    <div class="choice-option border rounded px-3 py-2 mb-2
                        {{ $question->correct_answer == 'A' ? 'border-success bg-success-subtle text-success fw-bold' : 'bg-light' }}"
                        style="cursor:pointer;"
                        onclick="setCorrectAnswer({{ $question->id }},'A')">

                        <strong>A.</strong>
                        {{ $question->option_a }}

                    </div>

                    <!-- B -->
                    <div class="choice-option border rounded px-3 py-2 mb-2
                        {{ $question->correct_answer == 'B' ? 'border-success bg-success-subtle text-success fw-bold' : 'bg-light' }}"
                        style="cursor:pointer;"
                        onclick="setCorrectAnswer({{ $question->id }},'B')">

                        <strong>B.</strong>
                        {{ $question->option_b }}

                    </div>

                    <!-- C -->
                    <div class="choice-option border rounded px-3 py-2 mb-2
                        {{ $question->correct_answer == 'C' ? 'border-success bg-success-subtle text-success fw-bold' : 'bg-light' }}"
                        style="cursor:pointer;"
                        onclick="setCorrectAnswer({{ $question->id }},'C')">

                        <strong>C.</strong>
                        {{ $question->option_c }}

                    </div>

                    <!-- D -->
                    <div class="choice-option border rounded px-3 py-2
                        {{ $question->correct_answer == 'D' ? 'border-success bg-success-subtle text-success fw-bold' : 'bg-light' }}"
                        style="cursor:pointer;"
                        onclick="setCorrectAnswer({{ $question->id }},'D')">

                        <strong>D.</strong>
                        {{ $question->option_d }}

                    </div>

                </div>

                @else

                <div class="alert alert-info mb-0">

                    <h6 class="fw-bold">

                        📷 File Upload Question

                    </h6>

                    Students will upload an image instead of selecting A, B, C, or D.

                </div>

                @endif

        </div>

    </div>

</div>
<script>

/* ================= EDIT ================= */

document.querySelectorAll('.editBtn').forEach(btn => {

    btn.addEventListener('click', function () {

        document.getElementById('editQuestion').value =
            this.dataset.question;

        document.getElementById('editForm').action =
            "/admin/questions/update/" + this.dataset.id;

        if(this.dataset.type === 'multiple_choice'){

            document.getElementById('choicesArea').style.display = "block";

            document.getElementById('editA').value = this.dataset.a;
            document.getElementById('editB').value = this.dataset.b;
            document.getElementById('editC').value = this.dataset.c;
            document.getElementById('editD').value = this.dataset.d;

        }else{

            document.getElementById('choicesArea').style.display = "none";

        }

        new bootstrap.Modal(
            document.getElementById('editModal')
        ).show();

    });

});


/* ================= DELETE ================= */

document.querySelectorAll('.deleteBtn').forEach(btn => {

    btn.addEventListener('click', function () {

        document.getElementById('deleteForm').action =
            "/admin/questions/delete/" + this.dataset.id;

        new bootstrap.Modal(
            document.getElementById('deleteModal')
        ).show();

    });

});

function setCorrectAnswer(questionId, answer)
{
    fetch('/admin/questions/correct-answer/' + questionId, {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':
                '{{ csrf_token() }}'
        },

        body: JSON.stringify({
            correct_answer: answer
        })

    })
    .then(res => res.json())
    .then(data => {

        location.reload();

    });
}

</script>
@endforeach

</div>

@endsection
<!-- ================= EDIT MODAL ================= -->

<div class="modal fade" id="editModal">

    <div class="modal-dialog modal-lg">

        <form method="POST" id="editForm">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">

                    <h5>Edit Question</h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <label>Question</label>
                    <textarea name="question"
                        id="editQuestion"
                        class="form-control mb-3"></textarea>

                    <div id="choicesArea">

                        <label>Option A</label>
                        <input type="text"
                            name="option_a"
                            id="editA"
                            class="form-control mb-2">

                        <label>Option B</label>
                        <input type="text"
                            name="option_b"
                            id="editB"
                            class="form-control mb-2">

                        <label>Option C</label>
                        <input type="text"
                            name="option_c"
                            id="editC"
                            class="form-control mb-2">

                        <label>Option D</label>
                        <input type="text"
                            name="option_d"
                            id="editD"
                            class="form-control mb-3">

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-success">
                        Update Question
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
<!-- ================= DELETE MODAL ================= -->

<div class="modal fade" id="deleteModal">

    <div class="modal-dialog">

        <form method="POST" id="deleteForm">

            @csrf
            @method('DELETE')

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="text-danger">
                        Delete Question
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    Are you sure you want to delete this question?

                </div>

                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button class="btn btn-danger">

                        Yes Delete

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>