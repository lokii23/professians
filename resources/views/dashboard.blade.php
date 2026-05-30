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

    .dashboard-header {

        margin-bottom: 30px;
    }

    .dashboard-title {

        font-size: 30px;

        font-weight: 700;

        color: white;

        margin-bottom: 5px;
    }

    .dashboard-subtitle {

        color: #94a3b8;

        font-size: 14px;
    }

    .exam-card {

        background: rgba(255,255,255,0.06);

        border: 1px solid rgba(255,255,255,0.08);

        backdrop-filter: blur(12px);

        border-radius: 22px;

        padding: 22px;

        height: 100%;

        transition: 0.3s;

        position: relative;

        overflow: hidden;
    }

    .exam-card::before {

        content: "";

        position: absolute;

        top: 0;
        left: 0;

        width: 100%;
        height: 4px;

        background:
            linear-gradient(
                90deg,
                #2563eb,
                #3b82f6,
                #60a5fa
            );
    }

    .exam-card:hover {

        transform: translateY(-5px);

        box-shadow:
            0 15px 30px rgba(0,0,0,0.25);
    }

    .exam-title {

        color: white;

        font-size: 18px;

        font-weight: 700;

        margin-bottom: 8px;

        line-height: 1.4;
    }

    .exam-description {

        color: #cbd5e1;

        font-size: 13px;

        min-height: 55px;
    }

    .exam-badge {

        background:
            linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

        color: white;

        padding: 6px 14px;

        border-radius: 30px;

        font-size: 11px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: 0.5px;
    }

    .take-btn {

        background:
            linear-gradient(
                135deg,
                #2563eb,
                #3b82f6
            );

        border: none;

        border-radius: 14px;

        padding: 12px;

        color: white;

        font-weight: 600;

        transition: 0.3s;

        text-decoration: none;

        display: block;

        text-align: center;
    }

    .take-btn:hover {

        transform: translateY(-2px);

        box-shadow:
            0 8px 20px rgba(37,99,235,0.35);

        color: white;
    }

    .taken-btn {

        background: rgba(255,255,255,0.08);

        border: 1px solid rgba(255,255,255,0.08);

        color: #94a3b8;

        border-radius: 14px;

        padding: 12px;

        width: 100%;

        font-weight: 600;
    }

</style>

<div class="container py-4">

    <!-- HEADER -->

    <div class="dashboard-header">

        <div class="dashboard-title">

            📚 Available Exams

        </div>

        <div class="dashboard-subtitle">

            Take your quizzes and examinations online

        </div>

    </div>

    <!-- EXAMS -->

    <div class="row g-4" id="examContainer">

    </div>

</div>

<script>

function loadExams()
{
    fetch('/live-exams')

    .then(response => response.json())

    .then(data => {

        let html = '';

        data.forEach(exam => {

            html += `

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="exam-card">

                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div class="exam-title">

                            ${exam.title}

                        </div>

                        <div class="exam-badge">

                            ${exam.type}

                        </div>

                    </div>

                    <div class="exam-description">

                        ${exam.description ?? 'No description available.'}

                    </div>

                    <div class="mt-4">

                        ${exam.taken
                        ? `
                            <button class="taken-btn" disabled>

                                Already Taken

                            </button>
                        `
                        : `
                            <a href="/exam/${exam.id}"
                               class="take-btn">

                                ${exam.type == 'quiz'
                                    ? 'Take Quiz'
                                    : 'Take Exam'}

                            </a>
                        `
                        }

                    </div>

                </div>

            </div>

            `;
        });

        document.getElementById('examContainer').innerHTML = html;

    });
}

loadExams();

setInterval(loadExams, 2000);

</script>

@endsection