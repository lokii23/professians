@extends('layouts.admin')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="card-modern p-4 mb-4 border">

        <h2 class="fw-bold mb-1">
            Review Result
        </h2>

        <p class="mb-0">
            Student:
            <strong>{{ $result->user->name }}</strong>
        </p>

        <p class="mb-0">
            Score:
            <strong>{{ $result->score }}</strong>
        </p>

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

                @php
                    $options = [
                        'A' => $answer->question->option_a,
                        'B' => $answer->question->option_b,
                        'C' => $answer->question->option_c,
                        'D' => $answer->question->option_d,
                    ];
                @endphp

                @foreach($options as $key => $value)

                <div class="
                    border
                    rounded-3
                    px-3
                    py-2
                    mb-2

                    @if($answer->question->correct_answer == $key)
                        border-success bg-success-subtle
                    @elseif($answer->student_answer == $key)
                        border-danger bg-danger-subtle
                    @endif
                ">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <strong>{{ $key }}.</strong>
                            {{ $value }}

                        </div>

                        <div>

                            @if($answer->question->correct_answer == $key)

                                <span class="badge bg-success">
                                    Correct
                                </span>

                            @elseif($answer->student_answer == $key)

                                <span class="badge bg-danger">
                                    Chosen
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>

    @endforeach

</div>

@endsection