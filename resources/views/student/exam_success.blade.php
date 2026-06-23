@extends('layouts.student')

@section('content')

<div class="d-flex justify-content-center align-items-center"
     style="height: 80vh;">

    <div class="text-center">

        <!-- CHECK ANIMATION -->
        <div class="checkmark-container mb-4">

            <div class="checkmark-circle">

                <div class="background"></div>

                <div class="checkmark draw"></div>

            </div>

        </div>

        <h2 class="fw-bold text-success">
            Exam Submitted Successfully!
        </h2>

        <p class="text-muted mt-2">
            Your answers have been recorded.
        </p>

    </div>

</div>

<style>

.checkmark-container {
    display: flex;
    justify-content: center;
}

.checkmark-circle {
    width: 120px;
    height: 120px;
    position: relative;
    display: inline-block;
    vertical-align: top;
}

.checkmark-circle .background {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: #28a745;
    position: absolute;
}

.checkmark {
    border-radius: 5px;
}

.checkmark.draw:after {
    animation-delay: 100ms;
    animation-duration: 1s;
    animation-timing-function: ease;
    animation-name: checkmark;
    transform: scaleX(-1) rotate(135deg);
    animation-fill-mode: forwards;
}

.checkmark:after {
    opacity: 0;
    height: 60px;
    width: 30px;
    transform-origin: left top;
    border-right: 8px solid white;
    border-top: 8px solid white;
    border-radius: 3px !important;
    content: '';
    left: 35px;
    top: 65px;
    position: absolute;
}

@keyframes checkmark {

    0% {
        height: 0;
        width: 0;
        opacity: 1;
    }

    20% {
        height: 0;
        width: 30px;
        opacity: 1;
    }

    40% {
        height: 60px;
        width: 30px;
        opacity: 1;
    }

    100% {
        height: 60px;
        width: 30px;
        opacity: 1;
    }
}

</style>

<script>

setTimeout(function () {

    window.location.href = "/student/result";

}, 1500);

</script>

@endsection