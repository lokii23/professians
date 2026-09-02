@extends('layouts.student')

@section('content')

<div class="container py-5">

    <a
        href="{{ route('student.grades') }}"
        class="btn btn-outline-light mb-4">

        ← Back to My Grades

    </a>


    <div class="mb-5">

        <div class="text-primary fw-bold">

            {{ $grade->subject->code }}

        </div>

        <h1 class="text-white fw-bold">

            {{ $grade->subject->name }}

        </h1>

        <p class="text-white-50">

            Your academic performance for this subject.

        </p>

    </div>


    {{-- OFFICIAL GRADES --}}

    <div class="row g-4 mb-5">

        <div class="col-md-4">

            <div class="grade-stat">

                <small>
                    Midterm Grade
                </small>

                <h2>

                    {{ number_format(
                        $grade->midterm_grade,
                        2
                    ) }}

                </h2>

            </div>

        </div>


        <div class="col-md-4">

            <div class="grade-stat">

                <small>
                    Final Grade
                </small>

                <h2>

                    {{ number_format(
                        $grade->final_grade,
                        2
                    ) }}

                </h2>

            </div>

        </div>


        <div class="col-md-4">

            <div class="grade-stat highlight">

                <small>
                    Final Rating
                </small>

                <h2>

                    {{ number_format(
                        $grade->final_rating,
                        2
                    ) }}

                </h2>

            </div>

        </div>

    </div>


    {{-- EXAM PERFORMANCE --}}

    <div class="card exam-performance">

        <div class="card-body p-4">

            <h4 class="text-white fw-bold mb-4">

                📝 Examination Scores

            </h4>

            @if($examScores->count())

                <div class="table-responsive">

                    <table class="table table-dark table-borderless align-middle">

                        <thead>

                            <tr>

                                <th>
                                    Examination
                                </th>

                                <th>
                                    Type
                                </th>

                                <th>
                                    Score
                                </th>

                                <th>
                                    Percentage
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($examScores as $exam)

                                @php

                                    $percentage =
                                        $exam->total_score > 0
                                        ? (
                                            $exam->score /
                                            $exam->total_score
                                        ) * 100
                                        : 0;

                                @endphp

                                <tr>

                                    <td class="text-white fw-semibold">

                                        {{ $exam->exam_name }}

                                    </td>

                                    <td>

                                        @if($exam->exam_type === 'midterm')

                                            <span class="badge bg-primary">
                                                Midterm
                                            </span>

                                        @elseif($exam->exam_type === 'final')

                                            <span class="badge bg-success">
                                                Final
                                            </span>

                                        @elseif($exam->exam_type === 'quiz')

                                            <span class="badge bg-warning text-dark">
                                                Quiz
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Other
                                            </span>

                                        @endif

                                    </td>

                                    <td class="text-white">

                                        <strong>
                                            {{ number_format($exam->score, 2) }}
                                        </strong>

                                        /
                                        {{ number_format($exam->total_score, 2) }}

                                    </td>

                                    <td>

                                        <strong class="text-info">

                                            {{ number_format(
                                                $percentage,
                                                2
                                            ) }}%

                                        </strong>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-info">

                    No examination scores have been posted
                    for this subject yet.

                </div>

            @endif

        </div>

    </div>

</div>


<style>
body{
        background:
        linear-gradient(
            135deg,
            #0f172a,
            #111827,
            #1e293b
        );

        min-height:100vh;
    }
.grade-stat{

    padding:
        25px;

    border-radius:
        18px;

    background:
        rgba(255,255,255,.06);

    border:
        1px solid rgba(255,255,255,.10);

    color:
        white;

}

.grade-stat small{

    color:
        rgba(255,255,255,.6);

}

.grade-stat h2{

    margin-top:
        10px;

    font-weight:
        800;

}

.grade-stat.highlight{

    border-color:
        rgba(34,197,94,.5);

}

.exam-performance{

    background:
        rgba(255,255,255,.05);

    border:
        1px solid rgba(255,255,255,.1);

    border-radius:
        20px;

}

</style>

@endsection