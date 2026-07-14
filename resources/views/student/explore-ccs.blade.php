@extends('layouts.student')

@section('content')
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<style>

body{
    background:
    linear-gradient(
        135deg,
        #0f172a,
        #111827,
        #1e293b
    );
}

/* HERO */

.hero{

    position:relative;

    height:600px;

    border-radius:28px;

    overflow:hidden;

    margin-bottom:50px;

    border:1px solid rgba(255,255,255,.08);

    box-shadow:0 20px 45px rgba(0,0,0,.35);

}

.hero img{

    width:100%;

    height:100%;

    object-fit:cover;

}

.hero-overlay{

    position:absolute;

    inset:0;

    background:
    linear-gradient(
        to top,
        rgba(0,0,0,.85),
        rgba(0,0,0,.40),
        transparent
    );

}

.hero-content{

    position:absolute;

    bottom:60px;

    left:60px;

    color:white;

    max-width:700px;

}

.hero-badge{

    display:inline-block;

    background:rgba(255,255,255,.12);

    backdrop-filter:blur(12px);

    padding:8px 18px;

    border-radius:30px;

    margin-bottom:20px;

    font-weight:600;

}

.hero-title{

    font-size:55px;

    font-weight:800;

    margin-bottom:15px;

}

.hero-text{

    font-size:18px;

    color:#d1d5db;

    line-height:1.8;

    margin-bottom:30px;

}

.hero-btn{

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );

    color:white;

    padding:15px 35px;

    border-radius:50px;

    text-decoration:none;

    font-weight:600;

    transition:.3s;

    margin-right:15px;

}

.hero-btn:hover{

    transform:translateY(-3px);

    color:white;

}

.hero-btn2{

    background:
    linear-gradient(
        135deg,
        #b40000,
        #ff0055
    );

    color:white;

    padding:15px 35px;

    border-radius:50px;

    text-decoration:none;

    font-weight:600;

    transition:.3s;

}

.hero-btn2:hover{

    transform:translateY(-3px);

    color:white;

}

.section-title{

    color:white;

    font-size:34px;

    font-weight:700;

}

.section-subtitle{

    color:#94a3b8;

    margin-bottom:40px;

}

/* ================= ABOUT CCS ================= */

.section-badge{

    display:inline-block;

    background:rgba(37,99,235,.15);

    color:#60a5fa;

    padding:8px 18px;

    border-radius:30px;

    font-weight:600;

    letter-spacing:1px;

}

.about-image{

    border-radius:25px;

    box-shadow:0 20px 45px rgba(0,0,0,.35);

    border:1px solid rgba(255,255,255,.08);

    transition:.35s;

}

.about-image:hover{

    transform:scale(1.02);

}

.about-title{

    color:white;

    font-size:42px;

    font-weight:700;

}

.highlight{

    color:#3b82f6;

}

.about-text{

    color:#cbd5e1;

    font-size:16px;

    line-height:1.9;

}

.stat-card{

    background:rgba(255,255,255,.06);

    border:1px solid rgba(255,255,255,.08);

    backdrop-filter:blur(12px);

    border-radius:18px;

    padding:25px;

    text-align:center;

    transition:.3s;

}

.stat-card:hover{

    transform:translateY(-6px);

}

.stat-card h2{

    color:white;

    font-weight:700;

    margin-bottom:5px;

}

.stat-card small{

    color:#94a3b8;

}
/*==========================
Vision Mission Core Values
==========================*/

.glass-card{

    background:rgba(255,255,255,.06);

    border:1px solid rgba(255,255,255,.08);

    backdrop-filter:blur(12px);

    border-radius:24px;

    padding:35px;

    text-align:center;

    height:100%;

    transition:.35s;

    box-shadow:0 10px 25px rgba(0,0,0,.20);

}

.glass-card:hover{

    transform:translateY(-10px);

    box-shadow:0 20px 40px rgba(37,99,235,.20);

}

.glass-icon{

    width:80px;

    height:80px;

    margin:auto;

    margin-bottom:20px;

    border-radius:20px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:38px;

    background:

    linear-gradient(

        135deg,

        #2563eb,

        #3b82f6

    );

    box-shadow:0 10px 30px rgba(37,99,235,.35);

}

.glass-card h3{

    color:white;

    font-size:26px;

    margin-bottom:18px;

    font-weight:700;

}

.glass-card p{

    color:#cbd5e1;

    line-height:1.9;

}

.values-list{

    list-style:none;

    padding:0;

    margin:0;

}

.values-list li{

    color:#e2e8f0;

    padding:12px;

    margin-bottom:12px;

    border-radius:12px;

    background:rgba(255,255,255,.05);

    transition:.3s;

}

.values-list li:hover{

    background:rgba(59,130,246,.18);

    transform:translateX(5px);

}
/*==========================
DEGREE PROGRAMS
==========================*/

.program-card{

    background:rgba(255,255,255,.06);

    backdrop-filter:blur(12px);

    border:1px solid rgba(255,255,255,.08);

    border-radius:28px;

    padding:45px;

    transition:.35s;

    box-shadow:0 15px 35px rgba(0,0,0,.25);

}

.program-card:hover{

    transform:translateY(-8px);

}

.program-icon{

    width:170px;

    height:170px;

    margin:auto;

    border-radius:35px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:90px;

    background:

    linear-gradient(

        135deg,

        #2563eb,

        #3b82f6

    );

    box-shadow:0 20px 40px rgba(37,99,235,.35);

}

.program-title{

    color:white;

    font-size:34px;

    font-weight:700;

}

.program-description{

    color:#cbd5e1;

    line-height:1.9;

    margin-top:20px;

}

.program-heading{

    color:#60a5fa;

    margin-bottom:15px;

    font-weight:600;

}

.program-list{

    list-style:none;

    padding:0;

}

.program-list li{

    color:#e5e7eb;

    padding:10px 0;

    border-bottom:1px solid rgba(255,255,255,.08);

}

.program-list li::before{

    content:"✔ ";

    color:#3b82f6;

    font-weight:bold;

}

/*==========================
NETFLIX SHOWCASE
==========================*/

.featured-player{

    background:#101010;

    border-radius:25px;

    overflow:hidden;

    box-shadow:0 20px 50px rgba(0,0,0,.4);

}

.featured-video{

    width:100%;

    height:650px;

    object-fit:cover;

    background:black;

}

.featured-info{

    padding:30px;

}

.featured-info h2{

    color:white;

    font-size:36px;

    font-weight:700;

}

.featured-info p{

    color:#cbd5e1;

    margin-top:15px;

    line-height:1.8;

}

.tech-tags span{

    display:inline-block;

    background:#2563eb;

    color:white;

    padding:8px 15px;

    margin:5px;

    border-radius:30px;

    font-size:13px;

}

.row-title{

    color:white;

    font-size:28px;

    margin-bottom:20px;

    font-weight:700;

}

.video-row{

    display:flex;

    gap:20px;

    overflow-x:auto;

    padding-bottom:15px;

    scroll-behavior:smooth;

}

.video-row::-webkit-scrollbar{

    display:none;

}

.video-card{

    min-width:300px;

    position:relative;

    cursor:pointer;

    transition:.35s;

}

.video-card img{

    width:100%;

    height:180px;

    object-fit:cover;

    border-radius:18px;

}

.video-card:hover{

    transform:scale(1.08);

    z-index:5;

}

.video-card h5{

    color:white;

    margin-top:12px;

    text-align:center;

}

.video-overlay{

    position:absolute;

    inset:0;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:70px;

    color:white;

    background:rgba(0,0,0,.45);

    opacity:0;

    transition:.3s;

    border-radius:18px;

}

.video-card:hover .video-overlay{

    opacity:1;

}
/* =========================
NETFLIX SCROLL BUTTON
========================= */


.video-container{

    position:relative;

}


.video-row{

    display:flex;

    gap:20px;

    overflow-x:hidden;

    padding:20px 40px;

    scroll-behavior:smooth;

}


.scroll-btn{

    position:absolute;

    top:45%;

    transform:translateY(-50%);

    width:55px;

    height:90px;

    border:none;

    border-radius:12px;

    background:rgba(0,0,0,.65);

    color:white;

    font-size:45px;

    cursor:pointer;

    z-index:10;

    transition:.3s;

}


.scroll-btn:hover{

    background:#2563eb;

    transform:translateY(-50%) scale(1.1);

}


.scroll-btn.left{

    left:0;

}


.scroll-btn.right{

    right:0;

}
/* ================================= */
/* FACULTY */
/* ================================= */

/* ========================= */
/* GALLERY */
/* ========================= */

.gallery-img{

    width:100%;

    height:260px;

    object-fit:cover;

    border-radius:20px;

    cursor:pointer;

    transition:.45s;

    border:2px solid rgba(255,255,255,.08);

}

.gallery-img:hover{

    transform:scale(1.05);

    box-shadow:0 20px 40px rgba(0,0,0,.45);

    border-color:#ff0055;

}

.section-title{

    color:white;

    font-size:34px;

    font-weight:700;

    margin-bottom:10px;

}

.section-subtitle{

    color:#94a3b8;

    margin-bottom:35px;

}

/* faculty */
.faculty-title{
    color:white;
    font-size:32px;
    font-weight:800;
}

.faculty-subtitle{
    color:#94a3b8;
    margin-bottom:30px;
}

.faculty-card{
    background:rgba(15,23,42,.72);
    border:1px solid rgba(255,255,255,.06);
    backdrop-filter:blur(14px);

    border-radius:28px;
    padding:30px;

    text-align:center;

    box-shadow:0 15px 35px rgba(0,0,0,.35);

    transition:.3s ease;
}

.faculty-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(37,99,235,.25);
}

.faculty-photo{
    width:130px;
    height:130px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid rgba(59,130,246,.4);
    box-shadow:0 0 25px rgba(59,130,246,.35);
    cursor:pointer;
    transition:.3s;
}

.faculty-photo:hover{
    transform:scale(1.08);
}

#imageModal .modal-content{
    background:transparent;
}

#imageModal .modal-dialog{
    max-width:700px;
}

#imageModal img{
    transition:.3s;
}

#imageModal img:hover{
    transform:scale(1.02);
}

.faculty-name{
    color:white;
    font-size:22px;
    font-weight:700;

    margin-top:20px;
}

.faculty-position{
    color:#60a5fa;
    font-weight:600;
    margin-bottom:20px;
}

.info-box{
    background:rgba(255,255,255,.04);
    border:1px solid rgba(255,255,255,.05);

    border-radius:16px;

    padding:12px;
    margin-top:10px;
}

.info-label{
    color:#94a3b8;
    font-size:12px;
}

.info-value{
    color:white;
    font-size:14px;
    font-weight:600;
}

.custom-close{
    position:absolute;
    top:15px;
    right:15px;

    width:45px;
    height:45px;

    border:none;
    border-radius:50%;

    background:rgba(255,255,255,.1);

    color:white;
    font-size:24px;

    backdrop-filter:blur(10px);

    transition:.3s;
    z-index:1000;
}

.custom-close:hover{
    background:#ef4444;
    transform:rotate(90deg);
}

/* ===================================== */

.footer-section{

    background:rgba(255,255,255,.05);

    backdrop-filter:blur(15px);

    border-top:1px solid rgba(255,255,255,.08);

}

.footer-title{

    color:white;

    font-size:28px;

    font-weight:700;

}

.footer-heading{

    color:white;

    font-size:20px;

    margin-bottom:20px;

}

.footer-text{

    color:#cbd5e1;

    line-height:1.9;

}

.footer-line{

    border-color:rgba(255,255,255,.1);

    margin:40px 0 20px;

}

.footer-copy{

    color:#94a3b8;

}

/* SOCIAL */

.social-icons{

    margin-top:25px;

}

.social-icons a{

    width:50px;

    height:50px;

    display:inline-flex;

    align-items:center;

    justify-content:center;

    background:rgba(255,255,255,.08);

    color:white;

    border-radius:50%;

    margin-right:10px;

    transition:.35s;

    text-decoration:none;

}

.social-icons a:hover{

    transform:translateY(-6px);

    background:#2563eb;

    color:white;

}

#topBtn{

    position:fixed;

    right:30px;

    bottom:30px;

    width:55px;

    height:55px;

    border:none;

    border-radius:50%;

    background:linear-gradient(
        135deg,
        #ff0055,
        #2563eb
    );

    color:white;

    font-size:22px;

    display:none;

    z-index:999;

    box-shadow:0 10px 30px rgba(0,0,0,.4);

    transition:.3s;

}

#topBtn:hover{

    transform:translateY(-5px);

}
</style>

<div class="container py-4">

    <div class="hero">

        <img src="{{ asset('img/it24.jpg') }}">

        <div class="hero-overlay"></div>

        <div class="hero-content">

            <span class="hero-badge">

                🎓 College of Computer Studies

            </span>

            <div class="hero-title">

                Explore CCS

            </div>

            <div class="hero-text">

                Discover our vision, mission, academic programs,
                outstanding faculty members, innovative student
                projects, and memorable campus activities.

            </div>

            <a href="#programs"
               class="hero-btn">

                Degree Programs

            </a>

            <a href="#gallery"
               class="hero-btn2">

                Gallery

            </a>

        </div>

    </div>

    <div class="text-center">

        <h2 class="section-title">

            Welcome to the College of Computer Studies

        </h2>

        <p class="section-subtitle">

            Building Future IT Professionals Through Innovation and Excellence

        </p>

    </div>

    <!-- ================= ABOUT CCS ================= -->

    <section class="py-5">

        <div class="row align-items-center g-5">

            <!-- LEFT IMAGE -->

            <div class="col-lg-6">

                <img src="{{ asset('ccs.png') }}"
                    class="img-fluid about-image">

            </div>

            <!-- RIGHT CONTENT -->

            <div class="col-lg-6">

                <span class="section-badge">

                    ABOUT CCS

                </span>

                <h2 class="about-title mt-3">

                    Excellence in
                    <span class="highlight">

                        Information Technology

                    </span>

                </h2>

                <p class="about-text">

                    The College of Computer Studies is committed to producing
                    competent, innovative, and globally competitive Information
                    Technology professionals through quality instruction,
                    research, and community engagement.

                </p>

                <p class="about-text">

                    We provide students with modern laboratories, industry-based
                    learning experiences, and opportunities to develop technical,
                    analytical, and leadership skills that prepare them for the
                    rapidly evolving digital world.

                </p>

                <div class="row mt-4">

                    <div class="col-4">

                        <div class="stat-card">

                            <h2>

                                200+

                            </h2>

                            <small>

                                Students

                            </small>

                        </div>

                    </div>

                    <div class="col-4">

                        <div class="stat-card">

                            <h2>

                                5

                            </h2>

                            <small>

                                Faculty

                            </small>

                        </div>

                    </div>

                    <div class="col-4">

                        <div class="stat-card">

                            <h2>

                                4

                            </h2>

                            <small>

                                Laboratories

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ================= VISION MISSION CORE VALUES ================= -->

    <section class="py-5" id="vmc">

        <div class="text-center mb-5">

            <span class="section-badge">

                OUR FOUNDATION

            </span>

            <h2 class="section-title mt-3">

                Vision, Mission & Core Values

            </h2>

            <p class="section-subtitle">

                The guiding principles of the College of Computer Studies.

            </p>

        </div>

        <div class="row g-4">

            <!-- Vision -->

            <div class="col-lg-4">

                <div class="glass-card">

                    <div class="glass-icon">

                        👁️

                    </div>

                    <h3>

                        Vision

                    </h3>

                    <p>

                        To become a premier institution in Information Technology
                        education, producing globally competitive graduates through
                        excellence in teaching, research, innovation, and community
                        engagement.

                    </p>

                </div>

            </div>

            <!-- Mission -->

            <div class="col-lg-4">

                <div class="glass-card">

                    <div class="glass-icon">

                        🎯

                    </div>

                    <h3>

                        Mission

                    </h3>

                    <p>

                        To provide quality IT education through competent faculty,
                        modern technologies, industry partnerships, and student-
                        centered learning that develops technical excellence,
                        leadership, and ethical responsibility.

                    </p>

                </div>

            </div>

            <!-- Core Values -->

            <div class="col-lg-4">

                <div class="glass-card">

                    <div class="glass-icon">

                        ⭐

                    </div>

                    <h3>

                        Core Values

                    </h3>

                    <ul class="values-list">

                        <li>Integrity</li>

                        <li>Innovation</li>

                        <li>Excellence</li>

                        <li>Professionalism</li>

                        <li>Service</li>

                    </ul>

                </div>

            </div>

        </div>

    </section>
    
<!-- ================= DEGREE PROGRAMS ================= -->

<section class="py-5" id="programs">

    <div class="text-center mb-5">

        <span class="section-badge">

            ACADEMIC PROGRAMS

        </span>

        <h2 class="section-title mt-3">

            Degree Programs

        </h2>

        <p class="section-subtitle">

            Preparing students for careers in today's digital world.

        </p>

    </div>

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="program-card">

                <div class="row align-items-center">

                    <div class="col-lg-4 text-center">

                        <div class="program-icon">

                            💻

                        </div>

                    </div>

                    <div class="col-lg-8">

                        <h2 class="program-title">

                            Bachelor of Science in Information Technology

                        </h2>

                        <p class="program-description">

                            The BS Information Technology program equips students
                            with the knowledge and practical skills needed in
                            software development, networking, cybersecurity,
                            database management, cloud computing, and multimedia
                            technologies.

                        </p>

                        <div class="row mt-4">

                            <div class="col-md-6">

                                <h5 class="program-heading">

                                    What You'll Learn

                                </h5>

                                <ul class="program-list">

                                    <li>Web Development</li>

                                    <li>Programming</li>

                                    <li>Networking</li>

                                    <li>Cybersecurity</li>

                                    <li>Database Systems</li>

                                    <li>Mobile Development</li>
                                    <li>Video Editing</li>
                                    <li>Graphic Design</li>

                                </ul>

                            </div>

                            <div class="col-md-6">

                                <h5 class="program-heading">

                                    Career Opportunities

                                </h5>

                                <ul class="program-list">

                                    <li>Software Developer</li>

                                    <li>Web Developer</li>

                                    <li>Network Administrator</li>

                                    <li>System Analyst</li>

                                    <li>Database Administrator</li>

                                    <li>Cybersecurity Specialist</li>
                                    <li>Video Editor</li>
                                    <li>Graphic Designer</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- ========================================= -->
<!-- CREATIVE MEDIA SHOWCASE -->
<!-- ========================================= -->

<section class="py-5">

    <div class="text-center mb-5">

        <span class="section-badge">

            CREATIVE MEDIA

        </span>

        <h2 class="section-title mt-3">

            BSIT Students Project Showcase

        </h2>

        <p class="section-subtitle">

            Discover the best multimedia and video editing projects created by CCS students.

        </p>

    </div>

    <!-- FEATURED PLAYER -->

    <div class="featured-player">

        <video
            id="mainVideo"
            controls
            autoplay
            muted
            class="featured-video">

            <source
                id="mainSource"
                src="{{ asset('videos/project1.mp4') }}"
                type="video/mp4">

        </video>

        <div class="featured-info">

            <h2 id="videoTitle">

                Kung ’Di Rin Lang Ikaw

            </h2>

            <p id="videoDescription">

                A heartfelt interpretative music video expressing emotions through storytelling, cinematography, and creative editing.

            </p>

            <div class="tech-tags">

                <span>Premiere Pro</span>
                
                <span>CCS Video Production</span>

                <span>ELECTIVE 3</span>


            </div>

        </div>

    </div>

    <!-- CONTINUE WATCHING -->

    <h3 class="row-title mt-5">

        Continue Watching

    </h3>

    <div class="video-container">

        <button class="scroll-btn left"
                onclick="scrollVideos(-400)">
            ❮
        </button>
        

        <div class="video-row" id="videoRow">

        <!-- VIDEO 1 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project1.mp4') }}',
                'Kung ’Di Rin Lang Ikaw',
                'A heartfelt interpretative music video expressing emotions through storytelling, cinematography, and creative editing.'
            )">

            <img
                src="{{ asset('img/thumb1.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Kung ’Di Rin Lang Ikaw

            </h5>

        </div>

        <!-- VIDEO 2 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project2.mp4') }}',
                'Dilaw',
                'A cinematic interpretation of love and happiness through creative storytelling, visuals, and emotional performances.'
            )">

            <img
                src="{{ asset('img/thumb2.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Dilaw

            </h5>

        </div>

        <!-- VIDEO 3 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project3.mp4') }}',
                'Sining',
                'A romantic visual storytelling project combining music, acting, and artistic direction.'
            )">

            <img
                src="{{ asset('img/thumb3.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Sining

            </h5>

        </div>

        <!-- VIDEO 4 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project4.mp4') }}',
                'I’ll Never Go',
                'A heartfelt music video interpretation portraying love, memories, and emotions through cinematic storytelling and creative editing.'
            )">

            <img
                src="{{ asset('img/thumb4.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                I’ll Never Go

            </h5>
        </div>

        <!-- VIDEO 5 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project5.mp4') }}',
                'Jopay',
                'A creative music video interpretation showcasing youthful emotions, storytelling, and cinematic video production.'
            )">

            <img
                src="{{ asset('img/thumb5.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Jopay

            </h5>
        </div>
        <!-- VIDEO 6 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project6.mp4') }}',
                'Multo',
                'A cinematic music video interpretation portraying emotions, memories, and storytelling through creative visuals and editing.'
            )">

            <img
                src="{{ asset('img/thumb6.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Multo

            </h5>
        </div>
        <!-- VIDEO 7 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project7.mp4') }}',
                'Palagi',
                'A heartfelt music video interpretation showcasing love, emotions, and meaningful storytelling through cinematic visuals.'
            )">

            <img
                src="{{ asset('img/thumb7.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Palagi

            </h5>
        </div>
        <!-- VIDEO 8 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project8.mp4') }}',
                'Huling Sandali',
                'A dramatic music video interpretation capturing emotions, memories, and heartfelt moments through cinematic storytelling.'
            )">

            <img
                src="{{ asset('img/thumb8.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Huling Sandali

            </h5>
        </div>

        <!-- VIDEO 9 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project9.mp4') }}',
                'Ang Huling El Bimbo',
                'A nostalgic music video interpretation portraying memories, emotions, and life stories through cinematic storytelling.'
            )">

            <img
                src="{{ asset('img/thumb9.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Ang Huling El Bimbo

            </h5>
        </div>
        <!-- VIDEO 10 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project10.mp4') }}',
                'Sa Susunod na Habang Buhay',
                'A heartfelt music video interpretation portraying love, hope, and emotions through cinematic storytelling.'
            )">

            <img
                src="{{ asset('img/thumb10.png') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Sa Susunod na Habang Buhay

            </h5>
        </div>


        <button class="scroll-btn right"
        onclick="scrollVideos(400)">
            ❯
        </button>

        </div>
    </div>

</section>
<!-- ============================= -->
<!-- GALLERY -->
<!-- ============================= -->

<section class="py-5">

    <div class="container">

        <h2 class="section-title mb-4">
            📸 CCS Gallery
        </h2>

        <p class="section-subtitle mb-5">
            Capturing moments of innovation, collaboration, and student life.
        </p>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g1.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g2.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g3.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g4.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g5.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g6.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g7.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g8.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/g9.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

        </div>

    </div>

</section>

<!-- ================================= -->
<!-- FACULTY MEMBERS -->
<!-- ================================= -->
<!-- FACULTY -->


<div class="container py-4">

    <div class="mb-4">

        <h2 class="faculty-title">
            👨‍🏫 CCS Faculty
        </h2>

        <p class="faculty-subtitle">
            Meet the faculty members of the College of Computer Studies
        </p>

    </div>

    <div class="row g-4">

        <!-- Faculty 1 -->
        <div class="col-lg-3 col-md-6">

            <div class="faculty-card">

                <img src="/faculty/teacher1.jpg"
                    class="faculty-photo"
                    onclick="showImage('/faculty/teacher1.jpg')">

                <div class="faculty-name">
                    Benjie S. Polo
                </div>

                <div class="faculty-position">
                    CCS OIC
                </div>

                <div class="info-box">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        benjiepolo@professians
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Advisory</div>
                    <div class="info-value">
                        4th Year Adviser
                    </div>
                </div>

            </div>

        </div>

        <!-- Faculty 2 -->
        <div class="col-lg-3 col-md-6">

            <div class="faculty-card">

                <img src="/faculty/teacher3.jpg"
                    class="faculty-photo"
                    onclick="showImage('/faculty/teacher3.jpg')">

                <div class="faculty-name">
                    Wheljine C. Talavera
                </div>

                <div class="faculty-position">
                    FACULTY
                </div>

                <div class="info-box">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        caballero@professians
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Advisory</div>
                    <div class="info-value">
                        3rd Year Adviser
                    </div>
                </div>
                <div class="info-box">
                    <div class="info-label" style="color: #ff0055;">DEVELOPER</div>
                </div>
            </div>

        </div>

        <!-- Faculty 3 -->
        <div class="col-lg-3 col-md-6">

            <div class="faculty-card">

                <img src="/faculty/teacher_2.jpg"
                    class="faculty-photo"
                    onclick="showImage('/faculty/teacher_2.jpg')">

                <div class="faculty-name">
                    Bob Keri O. Bacus
                </div>

                <div class="faculty-position">
                    FACULTY
                </div>

                <div class="info-box">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        keribacus@professians
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Advisory</div>
                    <div class="info-value">
                        2nd Year Adviser
                    </div>
                </div>

            </div>

        </div>

        <!-- Faculty 4 -->
        <div class="col-lg-3 col-md-6">

            <div class="faculty-card">

                <img src="/faculty/teacher_4.jpg"
                    class="faculty-photo"
                    onclick="showImage('/faculty/teacher_4.jpg')">

                <div class="faculty-name">
                    Bernce Villacorta
                </div>

                <div class="faculty-position">
                    FACULTY
                </div>

                <div class="info-box">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        bernce@professians
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">Advisory</div>
                    <div class="info-value">
                        1st Year Adviser
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<div class="modal fade"
     id="imageModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content bg-transparent border-0">

             <button
                class="custom-close"
                data-bs-dismiss="modal">
                ✕
            </button>

            <div class="text-center">

                <img id="enlargedImage"
                     src=""
                     class="img-fluid rounded-4 shadow-lg"
                     style="
                        max-height:90vh;
                        object-fit:contain;
                     ">

            </div>

        </div>

    </div>

</div>
<!-- ================================= -->
<!-- FOOTER -->
<!-- ================================= -->

<footer class="footer-section mt-5">

    <div class="container py-5">

        <div class="row">

            <!-- LEFT -->

            <div class="col-lg-4">

                <h3 class="footer-title">

                    College of Computer Studies

                </h3>

                <p class="footer-text">

                    Developing future-ready IT professionals through
                    innovation, technology, and excellence.

                </p>

                <div class="social-icons">

                    <a href="https://www.facebook.com/PAPCCS2022/" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="https://www.youtube.com/watch?v=9t9GN67I3cY" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>

                </div>

            </div>

            <!-- CONTACT -->

            <div class="col-lg-4">

                <h4 class="footer-heading">

                    Contact Information

                </h4>

                <p class="footer-text">

                    📍 Professional Academy of the Philippines

                </p>

                <p class="footer-text">

                    📞 +63 912 345 6789

                </p>

                <p class="footer-text">

                    📧 ccs@pap.edu.ph

                </p>

            </div>

            <!-- MAP -->

            <div class="col-lg-4">

                <h4 class="footer-heading">

                    Find Us

                </h4>

                <iframe

                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d888.3671516343499!2d123.75426736953429!3d10.204128419262156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a97853a1ef0a53%3A0x33c142d07a44658a!2sProfessional%20Academy%20of%20the%20Philippines!5e1!3m2!1sen!2sph!4v1784009200580!5m2!1sen!2sph"

                    width="100%"

                    height="180"

                    style="border:0;border-radius:18px"

                    loading="lazy">

                </iframe>

            </div>

        </div>

        <hr class="footer-line">

        <div class="text-center footer-copy">

            © 2026 College of Computer Studies • Professional Academy of the Philippines

        </div>

    </div>

</footer>
<button id="topBtn">

    <i class="fas fa-chevron-up"></i>

</button>

</div>
{{-- last part --}}


<!--MODAL -->
<div class="modal fade"
     id="galleryModal"
     tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content bg-dark border-0">

            <div class="modal-header border-0">

                <h5 class="text-white">
                    CCS Gallery
                </h5>

                <button class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <img id="galleryPreview"
                     class="img-fluid rounded-4">

            </div>

        </div>

    </div>

</div>
<script>

function changeVideo(video,title,description)
{

    const player=document.getElementById('mainVideo');

    document.getElementById('mainSource').src=video;

    player.load();

    player.play();

    document.getElementById('videoTitle').innerHTML=title;

    document.getElementById('videoDescription').innerHTML=description;

}

</script>
<script>

function openGallery(src)
{
    document.getElementById("galleryPreview").src = src;

    let modal = new bootstrap.Modal(
        document.getElementById("galleryModal")
    );

    modal.show();
}
</script>
<script>
function showImage(image)
{
    document.getElementById('enlargedImage').src = image;

    new bootstrap.Modal(
        document.getElementById('imageModal')
    ).show();
}
</script>
<script>
    function scrollVideos(amount)
{
    document
    .getElementById("videoRow")
    .scrollBy({

        left: amount,

        behavior:"smooth"

    });
}
</script>
<script>
    const topBtn = document.getElementById("topBtn");

window.onscroll = function(){

    if(document.documentElement.scrollTop > 300){

        topBtn.style.display="block";

    }else{

        topBtn.style.display="none";

    }

}

topBtn.onclick=function(){

    window.scrollTo({

        top:0,

        behavior:"smooth"

    });

}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection