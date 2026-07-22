@extends('layouts.admin')

@section('content')
<style>
::placeholder{

    color: rgba(255,255,255,0.5) !important;
    opacity:1;

}

</style>
<div class="container py-3">

    <!-- BACK BUTTON -->
    <div class="mb-3">

        <a href="{{ route('admin.questions', $exam->id) }}"
           class="btn btn-sm btn-outline-light shadow-sm px-3 rounded-pill" style="color: black">

            ← Back to Questions

        </a>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden"
         style="background: #0f172a;">

        <!-- HEADER -->
        <div class="px-4 py-3"
             style="
                background: linear-gradient(
                    135deg,
                    #1e3a8a,
                    #2563eb
                );
             ">

            <h4 class="text-white fw-bold mb-0">
                ➕ Add Question
            </h4>

        </div>

        <!-- BODY -->
        <div class="card-body p-4">

            <form method="POST" action="{{ route('admin.store-question') }}">
                @csrf

                <input type="hidden"
                    name="exam_id"
                    value="{{ $exam->id }}">

                <!-- QUESTION -->
                <div class="mb-4">

                    <label class="form-label text-white fw-semibold">
                        Question
                    </label>

                    <textarea
                        name="question"
                        rows="4"
                        class="form-control border-0 shadow-sm rounded-3"
                        style="background:#1e293b;color:white;"
                        placeholder="Enter your question..."
                        required></textarea>

                </div>


                <!-- QUESTION TYPE -->

                <div class="mb-4">

                    <label class="form-label text-white fw-semibold">

                        Question Type

                    </label>

                    <select
                        name="question_type"
                        id="questionType"
                        class="form-select border-0 shadow-sm rounded-3"
                        style="background:#1e293b;color:white;">

                        <option value="multiple_choice">

                            📝 Multiple Choice

                        </option>

                        <option value="file_upload">

                            📷 File Upload

                        </option>

                    </select>

                </div>


                <!-- MULTIPLE CHOICE FIELDS -->

                <div id="multipleChoiceFields">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label text-info">
                                Option A
                            </label>

                            <input
                                type="text"
                                name="option_a"
                                class="form-control border-0"
                                style="background:#1e293b;color:white;"
                                placeholder="Option A">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label text-info">
                                Option B
                            </label>

                            <input
                                type="text"
                                name="option_b"
                                class="form-control border-0"
                                style="background:#1e293b;color:white;"
                                placeholder="Option B">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label text-info">
                                Option C
                            </label>

                            <input
                                type="text"
                                name="option_c"
                                class="form-control border-0"
                                style="background:#1e293b;color:white;"
                                placeholder="Option C">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label text-info">
                                Option D
                            </label>

                            <input
                                type="text"
                                name="option_d"
                                class="form-control border-0"
                                style="background:#1e293b;color:white;"
                                placeholder="Option D">

                        </div>

                    </div>

                </div>


                <!-- FILE UPLOAD NOTICE -->

                <div id="uploadNotice"
                    class="alert alert-info"
                    style="display:none;">

                    <h6 class="fw-bold">

                        📷 File Upload Question

                    </h6>

                    Students will upload

                    <strong>ONE IMAGE</strong>

                    as their answer.

                    <hr>

                    Accepted:

                    JPG

                    JPEG

                    PNG

                </div>


                <!-- CORRECT ANSWER -->

                <div
                    class="mb-4"
                    id="correctAnswerField">

                    <label class="form-label text-white">

                        Correct Answer

                    </label>

                    <select
                        name="correct_answer"
                        class="form-select border-0"
                        style="background:#1e293b;color:white;">

                        <option value="">Select Correct Answer</option>

                        <option value="A">A</option>

                        <option value="B">B</option>

                        <option value="C">C</option>

                        <option value="D">D</option>

                    </select>

                </div>


                <!-- SAVE BUTTON (KEEP THIS OUTSIDE OF EVERYTHING) -->

                <div class="d-flex justify-content-end">

                    <button
                        class="btn px-4 py-2 rounded-pill text-white"
                        style="background:#2563eb;">

                        💾 Save Question

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>

const questionType = document.getElementById('questionType');

const mcFields = document.getElementById('multipleChoiceFields');

const answerField = document.getElementById('correctAnswerField');

const uploadNotice = document.getElementById('uploadNotice');

function toggleQuestionType() {

    if (questionType.value === "file_upload") {

        mcFields.style.display = "none";

        answerField.style.display = "none";

        uploadNotice.style.display = "block";

    } else {

        mcFields.style.display = "block";

        answerField.style.display = "block";

        uploadNotice.style.display = "none";

    }

}

questionType.addEventListener("change", toggleQuestionType);

toggleQuestionType();

</script>
@endsection