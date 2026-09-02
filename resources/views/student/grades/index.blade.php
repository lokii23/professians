@extends('layouts.student')

@section('content')

<div class="grades-page">

    <div class="container py-5">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="grades-header mb-5">

            <div>

                <div class="grades-eyebrow">
                    <span class="eyebrow-dot"></span>
                    ACADEMIC PERFORMANCE
                </div>

                <h1 class="grades-title">
                    My Grades
                </h1>

                <p class="grades-subtitle">
                    Track your academic performance, grades,
                    and subject ratings.
                </p>

            </div>

            <div class="academic-icon">

                <div class="academic-icon-inner">
                    🎓
                </div>

            </div>

        </div>


        {{-- =========================================================
            SUMMARY
        ========================================================== --}}

        @php

            $subjectCount = $grades->count();

            $midtermAverage = $subjectCount > 0
                ? $grades->avg('midterm_grade')
                : 0;

            $finalAverage = $subjectCount > 0
                ? $grades->avg('final_grade')
                : 0;

            $overallRating = $subjectCount > 0
                ? $grades->avg('final_rating')
                : 0;

        @endphp


        @if($grades->count() > 0)

        <div class="row g-4 mb-5">

            {{-- SUBJECTS --}}

            <div class="col-xl-3 col-md-6">

                <div class="summary-card">

                    <div class="summary-icon blue">
                        📚
                    </div>

                    <div class="summary-content">

                        <span>
                            Subjects
                        </span>

                        <strong>
                            {{ $subjectCount }}
                        </strong>

                        <small>
                            Enrolled subjects
                        </small>

                    </div>

                </div>

            </div>



            {{-- OVERALL --}}

            <div class="col-xl-3 col-md-6">

                <div class="summary-card overall-card">

                    <div class="summary-icon green">
                        🏆
                    </div>

                    <div class="summary-content">

                        <span>
                            Overall Rating
                        </span>

                        <strong>
                            {{ number_format(
                                $overallRating,
                                2
                            ) }}
                        </strong>

                        <small>
                            Current overall rating
                        </small>

                    </div>

                </div>

            </div>

        </div>

        @endif


        {{-- =========================================================
            NO GRADES
        ========================================================== --}}

        @if($grades->count() === 0)

            <div class="empty-grades">

                <div class="empty-icon">
                    📊
                </div>

                <h3>
                    No Grades Available
                </h3>

                <p>
                    Your grades have not been entered yet.
                    Please check again later.
                </p>

            </div>

        @else


        {{-- =========================================================
            SUBJECT SECTION
        ========================================================== --}}

        <div class="section-heading mb-4">

            <div>

                <div class="section-label">
                    YOUR SUBJECTS
                </div>

                <h2>
                    Academic Records
                </h2>

            </div>

            <div class="subject-count">

                {{ $grades->count() }}
                {{ $grades->count() === 1
                    ? 'Subject'
                    : 'Subjects'
                }}

            </div>

        </div>


        {{-- =========================================================
            SUBJECT CARDS
        ========================================================== --}}

        <div class="row g-4">

            @foreach($grades as $grade)

                @php

                    $rating = $grade->final_rating ?? 0;

                    if($rating <= 1.7) {

                        $status = 'Excellent';
                        $statusClass = 'excellent';

                    } elseif($rating <= 2.4) {

                        $status = 'Very Good';
                        $statusClass = 'very-good';

                    } elseif($rating <= 3.0) {

                        $status = 'Passed';
                        $statusClass = 'passed';

                    } else {

                        $status = 'Needs Improvement';
                        $statusClass = 'needs-improvement';

                    }

                @endphp


                <div class="col-xl-4 col-lg-6">

                    <div class="subject-card">

                        {{-- CARD TOP --}}

                        <div class="subject-top">

                            <div class="subject-info">

                                <div class="subject-code">

                                    {{ $grade->subject->code }}

                                </div>

                                <h3>

                                    {{ $grade->subject->name }}

                                </h3>

                            </div>

                            <div class="subject-symbol">
                                📚
                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="subject-status-row">

                            <span class="status-badge {{ $statusClass }}">

                                <span class="status-dot"></span>

                                {{ $status }}

                            </span>

                        </div>


                        <div class="subject-divider"></div>


                        {{-- GRADES --}}

                        <div class="grade-values">

                            {{-- MIDTERM --}}

                            <div class="grade-item">

                                <span class="grade-label">
                                    Midterm
                                </span>

                                <strong>

                                    {{ number_format(
                                        $grade->midterm_grade,
                                        2
                                    ) }}

                                </strong>

                                <span class="grade-description">
                                    Midterm Grade
                                </span>

                            </div>


                            <div class="grade-separator"></div>


                            {{-- FINAL --}}

                            <div class="grade-item">

                                <span class="grade-label">
                                    Final
                                </span>

                                <strong>

                                    {{ number_format(
                                        $grade->final_grade,
                                        2
                                    ) }}

                                </strong>

                                <span class="grade-description">
                                    Final Grade
                                </span>

                            </div>


                            <div class="grade-separator"></div>


                            {{-- RATING --}}

                            <div class="grade-item rating-item">

                                <span class="grade-label">
                                    Rating
                                </span>

                                <strong>

                                    {{ number_format(
                                        $grade->final_rating,
                                        2
                                    ) }}

                                </strong>

                                <span class="grade-description">
                                    Final Rating
                                </span>

                            </div>

                        </div>


                        {{-- PROGRESS --}}

                        <div class="rating-progress">

                            <div class="progress-header">

                                <span>
                                    Final Rating
                                </span>

                                <strong>
                                    {{ number_format(
                                        $grade->final_rating,
                                        2
                                    ) }}
                                </strong>

                            </div>

                            <div class="progress-track">

                                <div
                                    class="progress-fill"
                                    style="
                                        width:
                                        {{ min(
                                            max(
                                                $grade->final_rating,
                                                0
                                            ),
                                            100
                                        ) }}%;
                                    ">
                                </div>

                            </div>

                        </div>


                        {{-- VIEW BUTTON --}}

                        <a
                            href="{{ route(
                                'student.grades.subject',
                                $grade->subject_id
                            ) }}"
                            class="view-subject-btn">

                            <span>
                                View Subject Details
                            </span>

                            <span class="arrow">
                                →
                            </span>

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

        @endif

    </div>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */
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
.grades-page{

    min-height:100vh;

    padding-bottom:80px;

}


/* =========================================================
   HEADER
========================================================= */

.grades-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:35px;

    border-radius:28px;

    background:
        linear-gradient(
            135deg,
            rgba(37,99,235,.16),
            rgba(124,58,237,.10)
        );

    border:
        1px solid rgba(255,255,255,.10);

    box-shadow:
        0 20px 60px rgba(0,0,0,.20);

    position:relative;

    overflow:hidden;

}

.grades-header::before{

    content:"";

    position:absolute;

    width:300px;

    height:300px;

    right:-100px;

    top:-150px;

    background:
        rgba(59,130,246,.15);

    border-radius:50%;

    filter:blur(10px);

}

.grades-eyebrow{

    display:flex;

    align-items:center;

    gap:8px;

    font-size:12px;

    font-weight:700;

    letter-spacing:2px;

    color:#60a5fa;

    margin-bottom:10px;

}

.eyebrow-dot{

    width:7px;

    height:7px;

    border-radius:50%;

    background:#3b82f6;

    box-shadow:
        0 0 12px #3b82f6;

}

.grades-title{

    margin:0;

    color:white;

    font-size:42px;

    font-weight:800;

    letter-spacing:-1px;

}

.grades-subtitle{

    margin:
        10px 0 0;

    color:
        rgba(255,255,255,.55);

    font-size:15px;

}

.academic-icon{

    width:90px;

    height:90px;

    border-radius:25px;

    background:
        rgba(255,255,255,.08);

    border:
        1px solid rgba(255,255,255,.12);

    display:flex;

    align-items:center;

    justify-content:center;

    backdrop-filter:blur(15px);

    position:relative;

    z-index:2;

}

.academic-icon-inner{

    font-size:42px;

}


/* =========================================================
   SUMMARY CARDS
========================================================= */

.summary-card{

    height:100%;

    display:flex;

    align-items:center;

    gap:18px;

    padding:23px;

    border-radius:20px;

    background:
        rgba(255,255,255,.055);

    border:
        1px solid rgba(255,255,255,.09);

    backdrop-filter:blur(16px);

    transition:.3s;

}

.summary-card:hover{

    transform:
        translateY(-5px);

    border-color:
        rgba(59,130,246,.35);

    box-shadow:
        0 15px 35px rgba(0,0,0,.20);

}

.summary-icon{

    width:54px;

    height:54px;

    min-width:54px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:16px;

    font-size:23px;

}

.summary-icon.blue{

    background:
        rgba(59,130,246,.15);

}

.summary-icon.purple{

    background:
        rgba(139,92,246,.15);

}

.summary-icon.orange{

    background:
        rgba(249,115,22,.15);

}

.summary-icon.green{

    background:
        rgba(34,197,94,.15);

}

.summary-content{

    display:flex;

    flex-direction:column;

}

.summary-content span{

    color:
        rgba(255,255,255,.50);

    font-size:12px;

}

.summary-content strong{

    color:white;

    font-size:25px;

    font-weight:800;

    line-height:1.3;

}

.summary-content small{

    color:
        rgba(255,255,255,.32);

    font-size:11px;

}


/* =========================================================
   SECTION HEADER
========================================================= */

.section-heading{

    display:flex;

    justify-content:space-between;

    align-items:end;

}

.section-label{

    color:#60a5fa;

    font-size:11px;

    letter-spacing:2px;

    font-weight:700;

    margin-bottom:4px;

}

.section-heading h2{

    color:white;

    font-size:25px;

    font-weight:750;

    margin:0;

}

.subject-count{

    color:
        rgba(255,255,255,.45);

    font-size:13px;

}


/* =========================================================
   SUBJECT CARD
========================================================= */

.subject-card{

    height:100%;

    padding:25px;

    border-radius:23px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.075),
            rgba(255,255,255,.035)
        );

    border:
        1px solid rgba(255,255,255,.10);

    backdrop-filter:
        blur(18px);

    box-shadow:
        0 12px 35px rgba(0,0,0,.15);

    transition:
        transform .3s,
        border-color .3s,
        box-shadow .3s;

    position:relative;

    overflow:hidden;

}

.subject-card::before{

    content:"";

    position:absolute;

    width:130px;

    height:130px;

    right:-60px;

    top:-60px;

    border-radius:50%;

    background:
        rgba(37,99,235,.10);

}

.subject-card:hover{

    transform:
        translateY(-7px);

    border-color:
        rgba(59,130,246,.40);

    box-shadow:
        0 20px 50px rgba(0,0,0,.25);

}

.subject-top{

    display:flex;

    justify-content:space-between;

    align-items:flex-start;

}

.subject-code{

    color:#60a5fa;

    font-size:11px;

    font-weight:800;

    letter-spacing:1.5px;

    margin-bottom:7px;

}

.subject-info h3{

    color:white;

    font-size:20px;

    font-weight:750;

    margin:0;

    line-height:1.3;

}

.subject-symbol{

    width:48px;

    height:48px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:15px;

    background:
        rgba(59,130,246,.10);

    font-size:21px;

}


/* =========================================================
   STATUS
========================================================= */

.subject-status-row{

    margin-top:18px;

}

.status-badge{

    display:inline-flex;

    align-items:center;

    gap:7px;

    padding:6px 11px;

    border-radius:30px;

    font-size:11px;

    font-weight:700;

}

.status-dot{

    width:6px;

    height:6px;

    border-radius:50%;

}

.status-badge.excellent{

    color:#4ade80;

    background:
        rgba(34,197,94,.10);

}

.status-badge.excellent .status-dot{

    background:#4ade80;

}

.status-badge.very-good{

    color:#60a5fa;

    background:
        rgba(59,130,246,.10);

}

.status-badge.very-good .status-dot{

    background:#60a5fa;

}

.status-badge.passed{

    color:#facc15;

    background:
        rgba(234,179,8,.10);

}

.status-badge.passed .status-dot{

    background:#facc15;

}

.status-badge.needs-improvement{

    color:#fb7185;

    background:
        rgba(244,63,94,.10);

}

.status-badge.needs-improvement .status-dot{

    background:#fb7185;

}


/* =========================================================
   DIVIDER
========================================================= */

.subject-divider{

    height:1px;

    background:
        rgba(255,255,255,.08);

    margin:
        20px 0;

}


/* =========================================================
   GRADE VALUES
========================================================= */

.grade-values{

    display:flex;

    align-items:center;

    justify-content:space-between;

}

.grade-item{

    flex:1;

    text-align:center;

}

.grade-label{

    display:block;

    color:
        rgba(255,255,255,.45);

    font-size:11px;

    margin-bottom:7px;

}

.grade-item strong{

    display:block;

    color:white;

    font-size:21px;

    font-weight:800;

}

.grade-description{

    display:block;

    color:
        rgba(255,255,255,.25);

    font-size:9px;

    margin-top:3px;

}

.rating-item strong{

    color:#4ade80;

}

.grade-separator{

    width:1px;

    height:48px;

    background:
        rgba(255,255,255,.09);

}


/* =========================================================
   PROGRESS
========================================================= */

.rating-progress{

    margin-top:22px;

}

.progress-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:8px;

}

.progress-header span{

    color:
        rgba(255,255,255,.40);

    font-size:10px;

}

.progress-header strong{

    color:#4ade80;

    font-size:11px;

}

.progress-track{

    height:5px;

    background:
        rgba(255,255,255,.08);

    border-radius:20px;

    overflow:hidden;

}

.progress-fill{

    height:100%;

    border-radius:20px;

    background:
        linear-gradient(
            90deg,
            #2563eb,
            #4ade80
        );

    box-shadow:
        0 0 10px rgba(74,222,128,.3);

    transition:
        width .8s ease;

}


/* =========================================================
   VIEW BUTTON
========================================================= */

.view-subject-btn{

    margin-top:22px;

    display:flex;

    align-items:center;

    justify-content:space-between;

    width:100%;

    padding:12px 15px;

    border-radius:12px;

    text-decoration:none;

    color:white;

    background:
        rgba(37,99,235,.12);

    border:
        1px solid rgba(59,130,246,.15);

    font-size:12px;

    font-weight:600;

    transition:.3s;

}

.view-subject-btn:hover{

    background:#2563eb;

    border-color:#2563eb;

    color:white;

}

.view-subject-btn .arrow{

    font-size:18px;

    transition:.3s;

}

.view-subject-btn:hover .arrow{

    transform:
        translateX(4px);

}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-grades{

    text-align:center;

    padding:90px 30px;

    border-radius:25px;

    background:
        rgba(255,255,255,.045);

    border:
        1px solid rgba(255,255,255,.08);

}

.empty-icon{

    width:85px;

    height:85px;

    margin:
        0 auto 20px;

    border-radius:25px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:40px;

    background:
        rgba(59,130,246,.10);

}

.empty-grades h3{

    color:white;

    font-weight:750;

}

.empty-grades p{

    color:
        rgba(255,255,255,.45);

    margin:0;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    .grades-header{

        padding:25px;

    }

    .grades-title{

        font-size:32px;

    }

    .academic-icon{

        width:65px;

        height:65px;

    }

    .academic-icon-inner{

        font-size:30px;

    }

    .section-heading{

        align-items:flex-start;

        gap:10px;

    }

}

@media(max-width:480px){

    .grades-header{

        padding:20px;

    }

    .grades-title{

        font-size:28px;

    }

    .grades-subtitle{

        font-size:13px;

    }

    .academic-icon{

        display:none;

    }

    .subject-card{

        padding:20px;

    }

}

</style>

@endsection