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

        background: linear-gradient(
            90deg,
            #b40000,
            #ff0055,
            #2563eb
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

        background: rgba(253, 250, 250, 0.08);

        border: 1px solid rgba(255,255,255,0.08);

        color: #94a3b8;

        border-radius: 14px;

        padding: 12px;

        width: 100%;

        font-weight: 600;
    }
    .news-image {
    transition: all .3s ease;
    }

    .news-image:hover {
        transform: scale(1.03);
        box-shadow: 0 15px 35px rgba(0,0,0,.4);
    }

    .subscribe-card{
    background: rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 24px;
    overflow: hidden;
    position: relative;
}

.subscribe-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:4px;
    background: linear-gradient(
        90deg,
        #b40000,
        #ff0055,
        #2563eb
    );
}

.subscribe-title{
    color:white;
    font-size:32px;
    font-weight:700;
    margin-bottom:15px;
    margin-left: 40px;
}

.subscribe-title span{
    color:#ff4d4d;
}

.subscribe-text{
    color:#cbd5e1;
    font-size:15px;
    line-height:1.7;
    
    margin-left: 40px;
}

.subscribe-input{
    background:rgba(255,255,255,.08);
    border:none;
    color:white;
    border-radius:14px 0 0 14px;
    padding:14px 18px;
    
    margin-left: 40px;
}

.subscribe-input:focus{
    background:rgba(255,255,255,.12);
    color:white;
    box-shadow:none;
}

.subscribe-btn{
    background:linear-gradient(
        135deg,
        #b40000,
        #ff0055
    );
    border:none;
    border-radius:0 14px 14px 0;
    padding:14px 24px;
    font-weight:600;
}

.subscribe-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(255,0,85,.35);
}

.subscribe-image{
    max-width:280px;
    filter:drop-shadow(
        0 15px 30px rgba(0,0,0,.35)
    );
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
    
    <hr style="border-color: #ff0055; margin: 40px 0;">
    <!-- NEWS FEED -->
    <div class="position-relative mb-5">

    <video
        autoplay
        muted
        loop
        class="w-100 rounded-4"
        style="
            height:500px;
            object-fit:cover;
            border:1px solid rgba(255,255,255,.08);
        ">

        <source
            src="{{ asset('videos/Vlog2.mp4') }}"
            type="video/mp4">

    </video>

    <div class="position-absolute top-50 start-0 translate-middle-y px-5">

        <h1 class="text-white fw-bold">
            Welcome Professians!
        </h1>

        <p class="text-light">
            Innovate • Create • Lead
        </p>

        <a href="#"
           class="btn btn-danger px-4">
            Learn More
        </a>

    </div>

</div>
    <div class="dashboard-header">

        <div class="dashboard-title">

            📰 Campus News & Announcements

        </div>

        <div class="dashboard-subtitle">

            Latest updates from CCS Department

        </div>

    </div>

    <div class="row g-4">

        <!-- NEWS 1 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/ccsor.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    CCS General Orientation 2026

                </h5>

                <p class="text-light opacity-75">

                    The CCS General Orientation 2026 has been successfully conducted for all CCS students.
                    General Orientation this academic year.

                </p>

                <small class="text-info">

                    Posted June 13, 2026

                </small>

            </div>

        </div>

        <!-- NEWS 2 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/start.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    Start of Classes AY 2026 - 2027

                </h5>

                <p class="text-light opacity-75">

                    The College Level will officially begin classes on June 8, 2026, for the 1st semester A.Y. 2026-27. Please be guided.

                </p>

                <small class="text-info">

                    Posted May 29, 2026

                </small>

            </div>

        </div>

        <!-- NEWS 3 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/eow.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    Enrollment Advisory

                </h5>

                <p class="text-light opacity-75">

                    Join our Enrollment on Wheels.
                    Together, let's make starting your educational journey easier and faster. 💙

                </p>

                <small class="text-info">

                    Posted May 19, 2026

                </small>

            </div>

        </div>
        <!-- NEWS 4 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/ccs26.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    CCS DAYS 2026

                </h5>

                <p class="text-light opacity-75">

                    CCS Days 2026: Celebrating innovation, unity, and excellence.

                </p>

                <small class="text-info">

                    Posted February 14, 2026

                </small>

            </div>

        </div>
        <!-- NEWS 5 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/r1.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    Valentines Day February Random Shot

                </h5>

                <p class="text-light opacity-75">

                    Smiles, laughter, and Valentine’s vibes.

                </p>

                <small class="text-info">

                    Posted February 12, 2026

                </small>

            </div>

        </div>
        <!-- NEWS 6 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/intrams25.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    INTRAMURALS 2025

                </h5>

                <p class="text-light opacity-75">

                    One team, one goal, one unforgettable Intramurals 2025.

                </p>

                <small class="text-info">

                    Posted November 17, 2025

                </small>

            </div>

        </div>
        <!-- NEWS 7 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/shtm24.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    INTRAMURALS 2024

                </h5>

                <p class="text-light opacity-75">

                    SHTM Department: “Energy, excellence, and hospitality in action.”

                </p>

                <small class="text-info">

                    Posted October 30, 2024

                </small>

            </div>

        </div>
        <!-- NEWS 8 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/educ24.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    INTRAMURALS 2024

                </h5>

                <p class="text-light opacity-75">

                    BSED Department: “Leaders in the making, champions in spirit.”

                </p>

                <small class="text-info">

                    Posted October 30, 2024

                </small>

            </div>

        </div>
        <!-- NEWS 9 -->

        <div class="col-lg-4">

            <div class="exam-card">

                <img src="{{ asset('img/it24.jpg') }}"
                    class="img-fluid rounded-4 mb-3 news-image"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)"
                    style="height:220px;width:100%;object-fit:cover;cursor:pointer;">

                <h5 class="text-white fw-bold">

                    INTRAMURALS 2024

                </h5>

                <p class="text-light opacity-75">

                    BSIT Department: “Smart minds, strong strategies, unstoppable teamwork.”

                </p>

                <small class="text-info">

                    Posted October 30, 2024

                </small>

            </div>

        </div>

    </div>
</div>

<!-- IMAGE VIEWER MODAL -->


    <hr style="border-color: #ff0055; margin: 40px 0;">
    
    <!-- Subscribe Section -->
    <section class="mb-5">

        <div class="subscribe-card">

            <div class="row align-items-center">

                <div class="col-lg-7">

                    <h2 class="subscribe-title">
                        Become a <span>Professian</span> 🚀
                    </h2>

                    <p class="subscribe-text">
                        Join the College of Computer Studies and start your journey
                        toward innovation, leadership, and academic excellence.
                        Stay updated with admissions, announcements, and campus activities.
                    </p>

                    <form class="mt-4">

                        <div class="input-group">

                            <input
                                type="email"
                                class="form-control subscribe-input"
                                placeholder="Enter your email address">

                            <button
                                class="btn subscribe-btn"
                                type="submit">

                                Subscribe

                            </button>

                        </div>

                    </form>

                </div>

                <div class="col-lg-5 text-center">

                    <img
                        src="{{ asset('img/image.png') }}"
                        class="img-fluid subscribe-image"
                        alt="Professian">

                </div>

            </div>

        </div>

    </section>
    <!-- /Subscribe Section -->
<div class="modal fade"
     id="imageModal"
     tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content bg-dark border-0">

            <div class="modal-header border-0">

                <h5 class="modal-title text-white">

                    PROFESSIANS

                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <img id="modalImage"
                     src=""
                     class="img-fluid rounded-4"
                     style="max-height:80vh;">

            </div>

        </div>

    </div>

</div>
<script>

function showImage(src)
{
    document.getElementById('modalImage').src = src;
}

</script>
<script>

function loadExams()
{
    fetch('/live-exams')

    .then(response => response.json())

    .then(data => {

        let html = '';

        data.forEach(exam => {

            html += `

            <div class="col-lg-4 col-md-4 col-sm-6">

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection