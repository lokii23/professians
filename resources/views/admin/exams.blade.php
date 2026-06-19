@extends('layouts.admin')

@section('content')

<div class="card-modern">

    <div class="d-flex justify-content-between mb-3">
        <h5>📚 Exams</h5>

        <a href="{{ route('admin.create-exam') }}" class="btn btn-primary">
            + Create Exam
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
                <th>Questions</th>
                <th>Student Result Visibility</th>
            </tr>
        </thead>

        <tbody>
            @foreach($exams as $exam)
            <tr>
                <td>{{ $exam->title }}</td>
                <td>{{ $exam->description }}</td>
                <td>
                    {{ \App\Models\Question::where('exam_id', $exam->id)->count() }}
                </td>
                <td>


                    <!-- QUESTIONS -->
                    <a href="{{ route('admin.questions', $exam->id) }}"
                    class="btn btn-success btn-sm">

                        Questions

                    </a>
                    <!-- COPY EXAM -->
                    <form action="{{ route('admin.copy-exam', $exam->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf

                        <button class="btn btn-info btn-sm">
                            📋 Copy Exam
                        </button>

                    </form>
                    <!-- RESULTS -->
                    <a href="{{ route('admin.results', $exam->id) }}"
                    class="btn btn-primary btn-sm">

                        Results

                    </a>

                    <!-- EDIT -->
                    <button class="btn btn-warning btn-sm editBtn"
                        data-id="{{ $exam->id }}"
                        data-title="{{ $exam->title }}"
                        data-description="{{ $exam->description }}"
                        data-type="{{ $exam->type }}"
                        data-passkey="{{ $exam->passkey }}">
                        Edit
                    </button>

                    <!-- DELETE (IMPORTANT FIX HERE) -->
                    <button 
                        type="button"
                        class="btn btn-danger btn-sm deleteBtn"
                        data-id="{{ $exam->id }}">
                        Delete
                    </button>
                    <button 
                        class="btn btn-sm toggleBtn {{ $exam->is_active ? 'btn-info' : 'btn-secondary' }}"
                        data-id="{{ $exam->id }}"
                    >
                        @if($exam->is_active)
                            👁 Shown
                        @else
                            🚫 Hidden
                        @endif
                    </button>
                </td>
                <td>
                    
                    <form action="{{ route('admin.toggle-result', $exam->id) }}"
                        method="POST">

                        @csrf

                        <button class="btn btn-sm btn-dark">

                            Toggle Result

                        </button>
                        
                    @if($exam->show_result)

                        <span class="badge bg-success">
                            Visible
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Hidden
                        </span>

                    @endif
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>


<!-- ================= EDIT MODAL ================= -->

<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <form method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" name="title" id="editTitle" class="form-control mb-2" required>
                    <textarea name="description" id="editDescription" class="form-control mb-2" required ></textarea>

                    <select name="type" id="editType" class="form-control mb-2" required>
                        <option value="quiz">Quiz</option>
                        <option value="mid-exam">Midterm</option>
                        <option value="final-exam">Final</option>
                    </select>

                    <input type="text" name="passkey" id="editPasskey" class="form-control" required>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>


<!-- ================= DELETE MODAL ================= -->

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">

        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="text-danger">Delete Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to delete this exam?</p>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        No
                    </button>

                    <button type="submit" class="btn btn-danger">
                        Yes, Delete
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>
<div class="modal fade" id="editQuestionModal">

    <div class="modal-dialog">

        <form method="POST" id="editQuestionForm">
            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Question</h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <textarea name="question"
                        id="editQuestion"
                        class="form-control mb-2"></textarea>

                    <input type="text"
                        name="option_a"
                        id="editA"
                        class="form-control mb-2"
                        placeholder="Option A">

                    <input type="text"
                        name="option_b"
                        id="editB"
                        class="form-control mb-2"
                        placeholder="Option B">

                    <input type="text"
                        name="option_c"
                        id="editC"
                        class="form-control mb-2"
                        placeholder="Option C">

                    <input type="text"
                        name="option_d"
                        id="editD"
                        class="form-control mb-2"
                        placeholder="Option D">

                    <select name="correct_answer"
                        id="editAnswer"
                        class="form-control">

                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>

                    </select>

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

<!-- ================= JS ================= -->

<script>
/* EDIT */
document.querySelectorAll('.editBtn').forEach(btn => {

    btn.addEventListener('click', function () {

        document.getElementById('editTitle').value = this.dataset.title;
        document.getElementById('editDescription').value = this.dataset.description;
        document.getElementById('editType').value = this.dataset.type;
        document.getElementById('editPasskey').value = this.dataset.passkey;

        document.getElementById('editForm').action =
            "/admin/update-exam/" + this.dataset.id;

        new bootstrap.Modal(document.getElementById('editModal')).show();
    });

});


/* DELETE (FIXED SAFE VERSION) */
document.querySelectorAll('.deleteBtn').forEach(btn => {

    btn.addEventListener('click', function () {

        let id = this.dataset.id;

        document.getElementById('deleteForm').action =
            "/admin/delete-exam/" + id;

        new bootstrap.Modal(document.getElementById('deleteModal')).show();

    });

});

document.querySelectorAll('.toggleBtn').forEach(button => {

    button.addEventListener('click', function () {

        let id = this.dataset.id;
        let btn = this;

        fetch('/admin/toggle-exam/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {

            if(data.status) {

                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-info');

                btn.innerHTML = '👁 Shown';

            } else {

                btn.classList.remove('btn-info');
                btn.classList.add('btn-secondary');

                btn.innerHTML = '🚫 Hidden';
            }

        });

    });

});

</script>

@endsection 