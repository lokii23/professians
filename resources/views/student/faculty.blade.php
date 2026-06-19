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

.view-btn{
    margin-top:15px;
    width:100%;
    border:none;
    border-radius:14px;
    padding:10px;
    font-weight:600;
    color:white;
    background:linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );
    transition:.3s;
}

.view-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(37,99,235,.35);
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
                    onclick="showFaculty(
                        '/faculty/teacher1.jpg',
                        'Benjie S. Polo',
                        'CCS OIC',
                        'benjiepolo@professians',
                        '4th Year Adviser'
                    )">

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
                    onclick="showFaculty(
                        '/faculty/teacher3.jpg',
                        'Wheljine C. Talavera',
                        'FACULTY',
                        'caballero@professians',
                        '3rd Year Adviser'
                    )">

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
                    onclick="showFaculty(
                        '/faculty/teacher_2.jpg',
                        'Bob Keri O. Bacus',
                        'FACULTY',
                        'keribacus@professians',
                        '2nd Year Adviser'
                    )">

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
                    onclick="showFaculty(
                        '/faculty/teacher_4.jpg',
                        'Bernce Villacorta',
                        'FACULTY',
                        'bernce@professians',
                        '1st Year Adviser'
                    )">

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
     id="facultyModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark border-secondary">

            <div class="modal-header border-secondary">

                <h5 class="modal-title text-white">
                    Faculty Information
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <img id="modalPhoto"
                     class="rounded-circle mb-3"
                     style="
                        width:250px;
                        height:250px;
                        object-fit:cover;
                     ">

                <h4 id="modalName"
                    class="text-white">
                </h4>

                <div id="modalPosition"
                     class="text-info mb-3">
                </div>

                <div class="info-box">
                    <div class="info-label">
                        Email
                    </div>

                    <div id="modalEmail"
                         class="info-value">
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">
                        Advisory
                    </div>

                    <div id="modalAdvisory"
                         class="info-value">
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<script>
function showFaculty(
    photo,
    name,
    position,
    email,
    advisory
)
{
    document.getElementById('modalPhoto').src = photo;
    document.getElementById('modalName').innerText = name;
    document.getElementById('modalPosition').innerText = position;
    document.getElementById('modalEmail').innerText = email;
    document.getElementById('modalAdvisory').innerText = advisory;

    new bootstrap.Modal(
        document.getElementById('facultyModal')
    ).show();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection