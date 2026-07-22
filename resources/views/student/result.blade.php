@extends('layouts.student')

@section('content')

<style>

    body{

        background:
        linear-gradient(
            135deg,
            #0f172a,
            #111827,
            #1e1b4b
        );

        min-height:100vh;
    }

    /* ========================= */
    /* SECTION TITLE */
    /* ========================= */

    .section-title{

        display:flex;

        justify-content:space-between;

        align-items:center;

        margin-bottom:30px;

    }

    .section-title h2{

        font-weight:700;

        color:white;

        margin:0;

        font-size:34px;
    }

    .subtitle{

        color:rgba(255,255,255,0.65);

        font-size:15px;
    }

    .total-badge{

        background:
        linear-gradient(
            135deg,
            #4338ca,
            #7c3aed
        );

        color:white;

        padding:12px 22px;

        border-radius:16px;

        font-weight:600;

        margin-top:14px;

        display:inline-block;

        box-shadow:
        0 10px 25px rgba(124,58,237,0.25);
    }

    /* ========================= */
    /* RESULT CARD */
    /* ========================= */

    .result-card{

        background:rgba(255,255,255,0.08);

        backdrop-filter:blur(18px);

        border:1px solid rgba(255,255,255,0.08);

        border-radius:28px;

        padding:28px;

        position:relative;

        overflow:hidden;

        transition:0.35s;

        box-shadow:
        0 10px 35px rgba(0,0,0,0.22);

    }

    .result-card:hover{

        transform:translateY(-6px);

        box-shadow:
        0 20px 45px rgba(124,58,237,0.18);

    }

    .result-card::before{

        content:"";

        position:absolute;

        top:0;
        left:0;

        width:100%;
        height:5px;

        background:
        linear-gradient(
            90deg,
            #7c3aed,
            #4338ca
        );

    }

    /* ========================= */
    /* EXAM TITLE */
    /* ========================= */

    .exam-title{

        font-size:24px;

        font-weight:700;

        color:white;

        line-height:1.4;
    }

    .result-date{

        color:rgba(255,255,255,0.60);

        margin-top:8px;

        font-size:14px;
    }

    /* ========================= */
    /* SCORE CIRCLE */
    /* ========================= */

    .score-circle{

        width:100px;
        height:100px;

        border-radius:50%;

        background:
        linear-gradient(
            135deg,
            #7c3aed,
            #4338ca
        );

        color:white;

        display:flex;
        align-items:center;
        justify-content:center;

        flex-direction:column;

        box-shadow:
        0 10px 30px rgba(124,58,237,0.35);

        flex-shrink:0;

    }

    .score-circle small{

        opacity:0.8;
    }

    .score-circle h2{

        margin:0;

        font-size:30px;

        font-weight:700;
    }

    /* ========================= */
    /* PROGRESS */
    /* ========================= */

    .progress{

        height:12px;

        border-radius:30px;

        margin-top:24px;

        background:rgba(255,255,255,0.08);

        overflow:hidden;
    }

    .progress-bar{

        background:
        linear-gradient(
            90deg,
            #8b5cf6,
            #4338ca
        );

    }

    .score-text{

        margin-top:12px;

        color:rgba(255,255,255,0.70);

        font-size:14px;
    }

    /* ========================= */
    /* VIEW BUTTON */
    /* ========================= */

    .view-btn{

        width:100%;

        margin-top:22px;

        border:none;

        border-radius:16px;

        padding:14px;

        font-weight:600;

        color:white;

        background:
        linear-gradient(
            135deg,
            #7c3aed,
            #4338ca
        );

        transition:0.3s;

        box-shadow:
        0 10px 25px rgba(124,58,237,0.25);

    }

    .view-btn:hover{

        transform:translateY(-2px);

        opacity:0.95;
    }

    /* ========================= */
    /* HIDDEN RESULT */
    /* ========================= */

    .hidden-box{

        background:
        rgba(245,158,11,0.12);

        border:1px solid rgba(245,158,11,0.30);

        color:#fbbf24;

        padding:16px;

        border-radius:16px;

        font-weight:600;

        margin-top:22px;
    }

    /* ========================= */
    /* EMPTY STATE */
    /* ========================= */

    .empty-result{

        background:rgba(255,255,255,0.08);

        backdrop-filter:blur(18px);

        border:1px solid rgba(255,255,255,0.08);

        border-radius:28px;

        padding:80px 30px;

        text-align:center;

        box-shadow:
        0 10px 30px rgba(0,0,0,0.20);

    }

    .empty-result h2{

        color:white;

        font-weight:700;
    }

    .empty-result p{

        color:rgba(255,255,255,0.65);
    }

    /* ========================= */
    /* MOBILE */
    /* ========================= */

    @media(max-width:768px){

        .section-title{

            flex-direction:column;

            align-items:flex-start;

            gap:20px;

        }

        .exam-title{

            font-size:20px;
        }

        .score-circle{

            width:85px;
            height:85px;
        }

    }

</style>

<!-- TITLE -->

<div class="section-title">

    <div>

        <h2>
            📊 My Exam Results
        </h2>

        <small class="subtitle d-block mb-2">

            Track your exam scores and performance

        </small>

        <div class="total-badge">

            Total Exams Taken:
            {{ $results->count() }}

        </div>

    </div>

</div>

<!-- RESULTS -->

<div id="results-container">

@if($results->count() > 0)

    <div class="row">

        @foreach($results as $result)

            <div class="col-md-6 mb-4">

                <div class="result-card h-100">

                    <div class="d-flex justify-content-between align-items-center gap-3">

                        <div>

                            <div class="exam-title">

                                {{ $result->exam?->title ?? 'Deleted Exam' }}
                                -
                                {{ $result->exam?->description ?? 'No Description' }}   
                                

                            </div>

                            <div class="result-date">


                            </div>

                        </div>

                        @if($result->exam && $result->exam->show_result)

                            <div class="score-circle">

                                <small>Score</small>

                                <h2>

                                    {{ $result->score }}

                                </h2>

                            </div>

                        @endif

                    </div>

                    @if($result->exam && $result->exam->show_result)

                        <div class="progress">

                            <div class="progress-bar"
                                 role="progressbar"
                                 style="
                                 width:
                                 {{
                                    $result->exam &&
                                    $result->exam->questions &&
                                    $result->exam?->questions?->count() ?? 0

                                    ? ($result->score / $result->exam->questions->count()) * 100

                                    : 0
                                 }}%;
                                 border-radius:30px;
                                 ">

                            </div>

                        </div>

                        @php

                        $mcQuestions = $result->exam->questions
                            ->where('question_type','multiple_choice')
                            ->count();

                        $fileQuestions = $result->exam->questions
                            ->where('question_type','file_upload')
                            ->count();

                        @endphp

                        <div class="score-text">

                            Multiple Choice Score:
                            <strong>{{ $result->score }}</strong>
                            out of
                            <strong>{{ $mcQuestions }}</strong>

                        </div>

                        @if($fileQuestions > 0)

                        <div class="mt-2 text-warning">

                            📷
                            {{ $fileQuestions }}
                            File Upload Question(s)

                            <br>

                            <small>

                                These answers are checked manually by your teacher.

                            </small>

                        </div>

                        @endif

                        <a href="{{ route('student.result.view', $result->id) }}"
                           class="btn view-btn">

                            View Score

                        </a>

                    @else

                        <div class="hidden-box">

                            🔒 Result is currently hidden by your Teacher.

                        </div>

                    @endif

                </div>

            </div>

        @endforeach

    </div>

@else

    <div class="empty-result">

        <h2>
            📄 No Results Yet
        </h2>

        <p class="mt-3">

            You haven't taken any exams yet.

        </p>

    </div>

@endif

</div>

<script>

    setInterval(() => {

        fetch(window.location.href)

        .then(response => response.text())

        .then(data => {

            let parser = new DOMParser();

            let html = parser.parseFromString(data, 'text/html');

            let newContent =
                html.querySelector('#results-container');

            if (newContent) {

                document.querySelector('#results-container')
                    .innerHTML = newContent.innerHTML;
            }

        });

    }, 3000);

</script>

@endsection