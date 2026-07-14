@extends('layouts.student')

@section('content')

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

</style>

<div class="container py-4">

    <div class="hero">

        <img src="{{ asset('img/ccs26.jpg') }}">

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

                <img src="{{ asset('img/ccsor.jpg') }}"
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

                                500+

                            </h2>

                            <small>

                                Students

                            </small>

                        </div>

                    </div>

                    <div class="col-4">

                        <div class="stat-card">

                            <h2>

                                20+

                            </h2>

                            <small>

                                Faculty

                            </small>

                        </div>

                    </div>

                    <div class="col-4">

                        <div class="stat-card">

                            <h2>

                                10+

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

            Netflix Style Video Showcase

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

                CCS Promotional Video

            </h2>

            <p id="videoDescription">

                A cinematic promotional video showcasing the College of Computer Studies using Adobe Premiere Pro and After Effects.

            </p>

            <div class="tech-tags">

                <span>Premiere Pro</span>

                <span>After Effects</span>

                <span>Photoshop</span>

            </div>

        </div>

    </div>

    <!-- CONTINUE WATCHING -->

    <h3 class="row-title mt-5">

        Continue Watching

    </h3>

    <div class="video-row">

        <!-- VIDEO 1 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project1.mp4') }}',
                'CCS Promotional Video',
                'A cinematic promotional video showcasing the College of Computer Studies.'
            )">

            <img
                src="{{ asset('img/thumb1.jpg') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                CCS Promotional Video

            </h5>

        </div>

        <!-- VIDEO 2 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project2.mp4') }}',
                'Campus Documentary',
                'A documentary featuring campus life and student achievements.'
            )">

            <img
                src="{{ asset('img/thumb2.jpg') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Campus Documentary

            </h5>

        </div>

        <!-- VIDEO 3 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project3.mp4') }}',
                'Creative Short Film',
                'Student-produced short film with cinematic storytelling.'
            )">

            <img
                src="{{ asset('img/thumb3.jpg') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Creative Short Film

            </h5>

        </div>

        <!-- VIDEO 4 -->

        <div class="video-card"

            onclick="changeVideo(
                '{{ asset('videos/project4.mp4') }}',
                'Commercial Advertisement',
                'A commercial advertisement created by Multimedia students.'
            )">

            <img
                src="{{ asset('img/thumb4.jpg') }}">

            <div class="video-overlay">

                ▶

            </div>

            <h5>

                Commercial Advertisement

            </h5>

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
                <img src="{{ asset('img/gallery1.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/gallery2.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/gallery3.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/gallery4.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/gallery5.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/gallery6.jpg') }}"
                     class="gallery-img"
                     onclick="openGallery(this.src)">
            </div>

        </div>

    </div>

</section>

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



</div>
{{-- last part --}}

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection