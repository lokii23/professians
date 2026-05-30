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

            <form method="POST"
                  action="{{ route('admin.store-question') }}">

                @csrf

                <input type="hidden"
                       name="exam_id"
                       value="{{ $exam->id }}">

                <!-- QUESTION -->
                <div class="mb-4 text-white" >

                    <label class="form-label text-white fw-semibold">
                        Question
                    </label>

                    <textarea name="question"
                              rows="4"
                              class="form-control border-0 shadow-sm rounded-3"
                              style="
                                  background:#1e293b;
                                  color:white;
                              "
                              placeholder="Enter your question here..."
                              required></textarea>

                </div>

                <!-- OPTIONS -->
                <div class="row">

                    <!-- OPTION A -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label text-info fw-semibold">
                            Option A
                        </label>

                        <input type="text"
                               name="option_a"
                               class="form-control border-0 shadow-sm rounded-3"
                               style="
                                   background:#1e293b;
                                   color:white;
                               "
                               placeholder="Enter option A"
                               required>

                    </div>

                    <!-- OPTION B -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label text-info fw-semibold">
                            Option B
                        </label>

                        <input type="text"
                               name="option_b"
                               class="form-control border-0 shadow-sm rounded-3"
                               style="
                                   background:#1e293b;
                                   color:white;
                               "
                               placeholder="Enter option B"
                               required>

                    </div>

                    <!-- OPTION C -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label text-info fw-semibold">
                            Option C
                        </label>

                        <input type="text"
                               name="option_c"
                               class="form-control border-0 shadow-sm rounded-3"
                               style="
                                   background:#1e293b;
                                   color:white;
                               "
                               placeholder="Enter option C"
                               required>

                    </div>

                    <!-- OPTION D -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label text-info fw-semibold">
                            Option D
                        </label>

                        <input type="text"
                               name="option_d"
                               class="form-control border-0 shadow-sm rounded-3"
                               style="
                                   background:#1e293b;
                                   color:white;
                               "
                               placeholder="Enter option D"
                               required>

                    </div>

                </div>

                <!-- ANSWER -->
                <div class="mb-4">

                    <label class="form-label text-white fw-semibold">
                        Correct Answer
                    </label>

                    <select name="correct_answer"
                            class="form-select border-0 shadow-sm rounded-3"
                            style="
                                background:#1e293b;
                                color:white;
                            "
                            required>

                        <option value="">
                            Select Correct Answer
                        </option>

                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>

                    </select>

                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-end">

                    <button class="btn px-4 py-2 rounded-pill fw-semibold text-white"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    #2563eb,
                                    #1d4ed8
                                );
                                border:none;
                                box-shadow:0 0 20px rgba(37,99,235,.4);
                            ">

                        💾 Save Question

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection