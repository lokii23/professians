@extends('layouts.admin')

@section('content')
<div class="mb-3">

    <a href="{{ route('admin.results', $result->exam_id) }}"
       class="btn btn-secondary">

        ← Back to Results

    </a>

</div>
<div class="container py-4">

    <!-- HEADER -->
    <div class="card-modern p-4 mb-4 border">

        <h2 class="fw-bold mb-1">
            Review Result
        </h2>

        <p class="mb-0">
            Student:
            <strong>{{ $result->user->first_name }} {{ $result->user->last_name }}</strong>
        </p>

        <div class="mt-3">

            <form action="{{ route('admin.result.updateScore', $result->id) }}"
                method="POST"
                class="d-flex align-items-center gap-2">

                @csrf
                @method('PUT')

                <label class="fw-bold mb-0">
                    Score:
                </label>

                <input type="number"
                    name="score"
                    value="{{ $result->score }}"
                    min="0"
                    class="form-control"
                    style="width:120px;">

                <button class="btn btn-primary">
                    💾 Update Score
                </button>

            </form>

        </div>

    </div>

    <!-- QUESTIONS -->
    @foreach($result->answers as $answer)

    <div class="d-flex justify-content-center mb-3">

        <div class="card border shadow-sm"
             style="
                width: 100%;
                max-width: 720px;
                border-radius: 14px;
                overflow: hidden;
             ">

            <!-- QUESTION HEADER -->
            <div class="px-4 py-3 border-bottom bg-light">

                <h5 class="fw-bold mb-0"
                    style="line-height: 1.4;">

                    {{ $answer->question->question }}

                </h5>

            </div>

            <!-- CHOICES -->
            <div class="card-body p-4">

                @if($answer->question->question_type == 'multiple_choice')

                    @php
                        $options = [
                            'A' => $answer->question->option_a,
                            'B' => $answer->question->option_b,
                            'C' => $answer->question->option_c,
                            'D' => $answer->question->option_d,
                        ];
                    @endphp

                    @foreach($options as $key => $value)

                    <div class="border rounded-3 px-3 py-2 mb-2

                        @if($answer->question->correct_answer == $key)
                            border-success bg-success-subtle
                        @elseif($answer->student_answer == $key)
                            border-danger bg-danger-subtle
                        @endif">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <strong>{{ $key }}.</strong>
                                {{ $value }}

                            </div>

                            <div>

                                @if($answer->question->correct_answer == $key)

                                    <span class="badge bg-success">
                                        Correct Answer
                                    </span>

                                @elseif($answer->student_answer == $key)

                                    <span class="badge bg-danger">
                                        Student Answer
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between">

                        <div>

                            <strong>Student Answer:</strong>

                            {{ $answer->student_answer }}

                        </div>

                        <div>

                            @if($answer->is_correct)

                                <span class="badge bg-success">
                                    ✔ Correct
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    ✘ Incorrect
                                </span>

                            @endif

                        </div>

                    </div>

                @else

                    <h5 class="mb-3">
                        📷 Student Uploaded Image
                    </h5>

                    @if($answer->upload_path)

                        <img
                            src="{{ asset('storage/'.$answer->upload_path) }}"
                            class="img-fluid rounded shadow previewImage"
                            style="max-width:350px;cursor:pointer;"
                            data-image="{{ asset('storage/'.$answer->upload_path) }}">

                    @else

                        <div class="alert alert-danger">
                            No image uploaded.
                        </div>

                    @endif

                    <hr>

                    <p>

                        <strong>Current Status:</strong>

                        @if($answer->is_correct)

                            <span class="badge bg-success">
                                ✔ Correct
                            </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                Pending / Incorrect
                            </span>

                        @endif

                    </p>

                    <form
                        action="{{ route('admin.recheck.answer',$answer->id) }}"
                        method="POST">

                        @csrf

                        <button
                            class="btn {{ $answer->is_correct ? 'btn-danger' : 'btn-success' }}">

                            {{ $answer->is_correct
                                ? '❌ Mark Incorrect'
                                : '✔ Mark Correct' }}

                        </button>

                    </form>

                @endif

                </div>

        </div>

    </div>

    @endforeach

</div>


<!-- IMAGE PREVIEW MODAL -->

<div class="modal fade"
     id="imagePreviewModal"
     tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0 bg-dark">

            <div class="modal-header border-0">

                <h5 class="text-white">

                    Student Uploaded Image

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <img
                    id="modalPreviewImage"
                    src=""
                    class="img-fluid rounded">

            </div>

        </div>

    </div>

</div>

<script>

document.querySelectorAll('.previewImage').forEach(image => {

    image.addEventListener('click', function(){

        document.getElementById('modalPreviewImage').src =
            this.dataset.image;

        new bootstrap.Modal(
            document.getElementById('imagePreviewModal')
        ).show();

    });

});

</script>
@endsection