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

        min-height:100vh;
    }
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