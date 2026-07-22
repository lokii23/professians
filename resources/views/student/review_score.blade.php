@extends('layouts.student')

@section('content')

<style>

    body {

        background:
            linear-gradient(
                135deg,
                #0f172a,
                #111827,
                #1e293b
            );

        min-height: 100vh;
    }

    .result-wrapper {

        max-width: 850px;

        margin: auto;
    }

    .main-card {

        background: rgba(255,255,255,0.07);

        backdrop-filter: blur(14px);

        border: 1px solid rgba(255,255,255,0.08);

        border-radius: 24px;

        padding: 24px;

        box-shadow:
            0 10px 30px rgba(0,0,0,0.28);
    }

    .exam-title {

        color: white;

        font-size: 24px;

        font-weight: 700;

        margin-bottom: 4px;
    }

    .exam-subtitle {

        color: #cbd5e1;

        font-size: 13px;
    }

    .score-box {

        min-width: 90px;

        padding: 14px;

        border-radius: 18px;

        background:
            linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

        text-align: center;

        color: white;

        box-shadow:
            0 6px 18px rgba(37,99,235,0.25);
    }

    .score-box h2 {

        margin: 0;

        font-size: 30px;

        font-weight: 700;
    }

    .question-card {

        background: rgba(255,255,255,0.05);

        border: 1px solid rgba(255,255,255,0.06);

        border-radius: 18px;

        padding: 18px;

        margin-bottom: 18px;

        transition: 0.25s;
    }

    .question-card:hover {

        transform: translateY(-2px);
    }

    .question-title {

        color: white;

        font-size: 15px;

        font-weight: 600;

        margin-bottom: 14px;

        line-height: 1.5;
    }

    .option-box {

        padding: 10px 14px;

        border-radius: 12px;

        margin-bottom: 10px;

        font-size: 14px;

        border: 1px solid rgba(255,255,255,0.05);

        background: rgba(255,255,255,0.03);

        color: #e2e8f0;
    }

    .correct-answer {

        background:
            rgba(34,197,94,0.18);

        border-color:
            rgba(34,197,94,0.35);

        color: #dcfce7;
    }

    .wrong-answer {

        background:
            rgba(239,68,68,0.18);

        border-color:
            rgba(239,68,68,0.35);

        color: #fee2e2;
    }

    .badge-answer {

        display: inline-block;

        margin-top: 6px;

        padding: 3px 10px;

        border-radius: 20px;

        font-size: 11px;

        font-weight: 600;
    }

    .badge-correct {

        background: rgba(34,197,94,0.20);

        color: #86efac;
    }

    .badge-wrong {

        background: rgba(239,68,68,0.20);

        color: #fca5a5;
    }

</style>

<div class="container py-4">

    <div class="result-wrapper">

        <div class="main-card">

            <!-- HEADER -->

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <div class="exam-title">
                        {{ $result->user->first_name }} {{ $result->user->last_name }}
                    </div>

                    <div class="exam-subtitle">

                        Results - Review your answers

                    </div>

                </div>

                <div class="score-box">

                    <small>Score</small>

                    <h2>

                        {{ $result->score }}

                    </h2>

                </div>

            </div>

            <!-- QUESTIONS -->

            @foreach($result->answers as $index => $answer)

                <div class="question-card">

                    <div class="question-title">

                        {{ $index + 1 }}.
                        {{ $answer->question->question }}

                    </div>

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

                            <div class="
                                option-box

                                @if($answer->question->correct_answer == $key)
                                    correct-answer
                                @elseif($answer->student_answer == $key)
                                    wrong-answer
                                @endif
                            ">

                                <strong>{{ $key }}.</strong>

                                {{ $value }}

                                @if($answer->question->correct_answer == $key)

                                    <div class="badge-answer badge-correct">

                                        ✔ Correct Answer

                                    </div>

                                @elseif($answer->student_answer == $key)

                                    <div class="badge-answer badge-wrong">

                                        ✖ Your Answer

                                    </div>

                                @endif

                            </div>

                        @endforeach

                    @else

                        <div class="text-white mb-3">

                            <strong>📷 Uploaded Answer</strong>

                        </div>

                        @if($answer->upload_path)

                            <a href="{{ asset('storage/'.$answer->upload_path) }}"
                            target="_blank">

                                <img
                                    src="{{ asset('storage/'.$answer->upload_path) }}"
                                    class="img-fluid rounded shadow"
                                    style="
                                        max-width:300px;
                                        border-radius:15px;
                                        transition:.3s;
                                        cursor:pointer;
                                    ">

                            </a>

                        @else

                            <div class="alert alert-danger">

                                No image uploaded.

                            </div>

                        @endif

                        <div class="mt-3">

                            @if($answer->is_correct)

                                <span class="badge bg-success fs-6">

                                    ✔ Checked Correct by Teacher

                                </span>

                            @else

                                <span class="badge bg-warning text-dark fs-6">

                                    ⏳ Waiting for Teacher Review

                                </span>

                            @endif

                        </div>

                    @endif

                </div>

                @endforeach

        </div>

    </div>

</div>

@endsection