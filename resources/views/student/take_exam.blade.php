@extends('layouts.student')

@section('content')

<div class="container py-4" style="max-width: 950px;">

    <!-- EXAM HEADER -->
    <div class="exam-header mb-4">

        <div>
            <h2 class="exam-title mb-1">
                {{ $exam->title }}
            </h2>

            <p class="exam-subtitle mb-0">
                Read each question carefully before answering.
            </p>
        </div>

        <div class="exam-badge">
            {{ count($questions) }} Questions
        </div>

    </div>
    <div class="timer-box">

        ⏰ Time Left:
        <span id="timer"></span>

    </div>
    <form method="POST" id="examForm" action="{{ route('exam.submit') }}" enctype="multipart/form-data">

        @csrf

        <input type="hidden"
               name="exam_id"
               value="{{ $exam->id }}">

        @foreach($questions as $index => $q)

        <!-- QUESTION CARD -->
        <div class="question-card mb-4">

            <div class="question-number">
                {{ $index + 1 }}
            </div>

            <div class="question-content">

                <h5 class="question-text">
                    {{ $q->question }}
                </h5>

                @if($q->question_type == 'multiple_choice')

                <div class="options-wrapper">

                    <!-- OPTION A -->
                    <label class="option-box">

                        <input type="radio"
                            name="answers[{{ $q->id }}]"
                            value="A"
                            required>

                        <span class="option-letter">
                            A
                        </span>

                        <span class="option-text">
                            {{ $q->option_a }}
                        </span>

                    </label>

                    <!-- OPTION B -->
                    <label class="option-box">

                        <input type="radio"
                            name="answers[{{ $q->id }}]"
                            value="B">

                        <span class="option-letter">
                            B
                        </span>

                        <span class="option-text">
                            {{ $q->option_b }}
                        </span>

                    </label>

                    <!-- OPTION C -->
                    <label class="option-box">

                        <input type="radio"
                            name="answers[{{ $q->id }}]"
                            value="C">

                        <span class="option-letter">
                            C
                        </span>

                        <span class="option-text">
                            {{ $q->option_c }}
                        </span>

                    </label>

                    <!-- OPTION D -->
                    <label class="option-box">

                        <input type="radio"
                            name="answers[{{ $q->id }}]"
                            value="D">

                        <span class="option-letter">
                            D
                        </span>

                        <span class="option-text">
                            {{ $q->option_d }}
                        </span>

                    </label>

                </div>

                @else

                <div class="mt-4">

                    <label class="form-label text-white fw-bold">

                        Upload your answer

                    </label>

                    <input type="file"
                        class="form-control"
                        name="uploads[{{ $q->id }}]"
                        accept="image/*"
                        required>

                    <small class="text-light">

                        Allowed file: JPG, PNG, JPEG

                    </small>

                </div>

                @endif


            </div>

        </div>

        @endforeach

        <!-- SUBMIT BUTTON -->
        <button type="button"
                class="submit-btn"
                id="submitBtn">

            Submit Exam

        </button>

    </form>

</div>

<!-- ========================= -->
<!-- CONFIRM SUBMIT MODAL -->
<!-- ========================= -->

<div class="modal fade"
     id="submitModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content custom-modal border-0">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold text-white">
                    Confirm Submission
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-light pt-0">

                Are you sure you want to submit your exam?
                You cannot edit your answers after submission.

            </div>

            <div class="modal-footer border-0">

                <button type="button"
                        class="btn cancel-btn"
                        data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button"
                        class="btn confirm-btn"
                        id="confirmSubmit">

                    Yes Submit

                </button>

            </div>

        </div>

    </div>

</div>

<!-- ========================= -->
<!-- WARNING MODAL -->
<!-- ========================= -->

<div class="modal fade"
     id="warningModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content custom-modal border-0">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold text-danger">
                    Incomplete Exam
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-light pt-0">

                Please answer all questions before submitting the exam.

            </div>

            <div class="modal-footer border-0">

                <button type="button"
                        class="btn danger-btn"
                        data-bs-dismiss="modal">

                    OK

                </button>

            </div>

        </div>

    </div>

</div>

<!-- ========================= -->
<!-- STYLES -->
<!-- ========================= -->

<style>
    .timer-box{

    position:sticky;

    top:20px;

    z-index:999;

    background:#ef4444;

    color:white;

    padding:15px 25px;

    border-radius:14px;

    width:fit-content;

    font-weight:600;

    margin-bottom:20px;

    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}
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

/* HEADER */

.exam-header{
    background:
    linear-gradient(
        135deg,
        #4338ca,
        #7c3aed
    );

    border-radius:24px;
    padding:30px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    color:white;

    box-shadow:
    0 10px 40px rgba(124,58,237,0.35);

    border:1px solid rgba(255,255,255,0.08);
}

.exam-title{
    font-size:32px;
    font-weight:700;
}

.exam-subtitle{
    color:rgba(255,255,255,0.75);
}

.exam-badge{
    background:rgba(255,255,255,0.12);
    padding:12px 20px;
    border-radius:16px;
    font-weight:600;
    backdrop-filter:blur(12px);
}

/* QUESTION CARD */

.question-card{

    background:rgba(255,255,255,0.08);

    backdrop-filter:blur(18px);

    border:1px solid rgba(255,255,255,0.08);

    border-radius:24px;

    padding:28px;

    display:flex;
    gap:22px;

    transition:0.3s;

    box-shadow:
    0 8px 25px rgba(0,0,0,0.25);

}

.question-card:hover{

    transform:translateY(-4px);

    box-shadow:
    0 15px 40px rgba(124,58,237,0.20);

}

/* QUESTION NUMBER */

.question-number{

    min-width:58px;
    height:58px;

    background:
    linear-gradient(
        135deg,
        #7c3aed,
        #4338ca
    );

    border-radius:18px;

    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:20px;
    font-weight:700;

    box-shadow:
    0 5px 20px rgba(124,58,237,0.35);

}

/* QUESTION TEXT */

.question-content{
    flex:1;
}

.question-text{

    color:white;

    font-weight:600;

    line-height:1.6;

    margin-bottom:22px;

}

/* OPTIONS */

.options-wrapper{
    display:grid;
    gap:14px;
}

.option-box{

    background:rgba(255,255,255,0.05);

    border:1px solid rgba(255,255,255,0.08);

    border-radius:18px;

    padding:16px 18px;

    display:flex;
    align-items:center;

    gap:14px;

    cursor:pointer;

    transition:0.25s;

}

.option-box:hover{

    background:rgba(124,58,237,0.18);

    border-color:#8b5cf6;

    transform:translateX(4px);

}
.option-box.selected{

    background:rgba(34,197,94,.18);

    border:2px solid #22c55e;

    transform:translateX(4px);

    box-shadow:
        0 0 20px rgba(34,197,94,.35);

}
.option-box.selected .option-letter{

    background:
    linear-gradient(
        135deg,
        #16a34a,
        #22c55e
    );

}

.option-box.selected .option-text{

    color:#ffffff;

    font-weight:700;

}

.option-box input[type="radio"]{

    accent-color:#8b5cf6;

    transform:scale(1.2);

}

/* LETTER */

.option-letter{

    width:38px;
    height:38px;

    border-radius:12px;

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

    font-weight:700;

    flex-shrink:0;

}

/* TEXT */

.option-text{

    color:#e5e7eb;

    font-weight:500;

}

/* SUBMIT BUTTON */

.submit-btn{

    width:100%;

    border:none;

    padding:18px;

    border-radius:20px;

    background:
    linear-gradient(
        135deg,
        #7c3aed,
        #4338ca
    );

    color:white;

    font-size:18px;

    font-weight:700;

    margin-top:10px;

    transition:0.3s;

    box-shadow:
    0 10px 30px rgba(124,58,237,0.35);

}

.submit-btn:hover{

    transform:translateY(-3px);

    opacity:0.95;

}

/* MODAL */

.custom-modal{

    background:#111827;

    border-radius:24px;

    border:1px solid rgba(255,255,255,0.08);

    box-shadow:
    0 10px 40px rgba(0,0,0,0.45);

}

/* BUTTONS */

.confirm-btn{

    background:
    linear-gradient(
        135deg,
        #16a34a,
        #22c55e
    );

    color:white;

    border:none;

    padding:10px 18px;

    border-radius:12px;

    font-weight:600;

}

.cancel-btn{

    background:#374151;

    color:white;

    border:none;

    padding:10px 18px;

    border-radius:12px;

    font-weight:600;

}

.danger-btn{

    background:
    linear-gradient(
        135deg,
        #dc2626,
        #ef4444
    );

    color:white;

    border:none;

    padding:10px 18px;

    border-radius:12px;

    font-weight:600;

}

/* MOBILE */

@media(max-width:768px){

    .exam-header{

        flex-direction:column;

        align-items:flex-start;

        gap:18px;

    }

    .question-card{

        flex-direction:column;

    }

}

</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('submitBtn').addEventListener('click', function () {

    let unanswered = false;

    document.querySelectorAll('.question-card').forEach(function(card){

        let radios = card.querySelectorAll('input[type="radio"]');
        let file = card.querySelector('input[type="file"]');

        // Multiple Choice
        if(radios.length > 0){

            let checked = false;

            radios.forEach(function(r){

                if(r.checked){
                    checked = true;
                }

            });

            if(!checked){
                unanswered = true;
            }

        }

        // File Upload
        if(file !== null){

            if(file.files.length === 0){
                unanswered = true;
            }

        }

    });

    if(unanswered){

        new bootstrap.Modal(
            document.getElementById('warningModal')
        ).show();

        return;
    }

    new bootstrap.Modal(
        document.getElementById('submitModal')
    ).show();

});

</script>
<script>

    document.getElementById('confirmSubmit').addEventListener('click', function () {

    this.disabled = true;

    this.innerHTML = `
        <span class="spinner-border spinner-border-sm"></span>
        Submitting...
    `;

    document.getElementById('examForm').submit();

});

</script>
<script>
    // Highlight selected answer

document.querySelectorAll('input[type="radio"]').forEach(function(radio){

    radio.addEventListener('change', function(){

        // Get all radio buttons with the same question name
        let group =
            document.querySelectorAll(
                'input[name="' + this.name + '"]'
            );

        // Remove selected class
        group.forEach(function(item){

            item.closest('.option-box')
                .classList.remove('selected');

        });

        // Add selected class
        this.closest('.option-box')
            .classList.add('selected');

    });

});
</script>
<script>

    let duration = {{ $exam->duration }} * 60;

    let timer = duration;

    let display = document.getElementById('timer');

    let countdown = setInterval(function(){

        let minutes = Math.floor(timer / 60);
        let seconds = timer % 60;

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        timer--;

        if(timer < 0){

            clearInterval(countdown);

            alert("Time is up! Exam will now submit.");

            document.getElementById('examForm').submit();
        }

    },1000);

</script>


@endsection