@extends('layouts.student')

@section('content')

<style>

    body{
        background:
        linear-gradient(135deg,#0f172a,#1e293b,#334155);
    }

    .exam-wrapper{
        min-height:90vh;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:40px 20px;
    }

    .exam-box{
        width:100%;
        max-width:500px;

        background:rgba(255,255,255,0.08);

        backdrop-filter:blur(12px);

        border:1px solid rgba(255,255,255,0.1);

        border-radius:24px;

        padding:40px;

        box-shadow:0 10px 40px rgba(0,0,0,0.35);

        color:white;

        animation:fadeIn .5s ease;
    }

    .exam-title{
        font-size:30px;
        font-weight:700;
        margin-bottom:10px;
    }

    .exam-desc{
        color:#cbd5e1;
        font-size:15px;
        margin-bottom:30px;
    }

    .passkey-title{
        text-align:center;
        margin-bottom:25px;
        font-size:22px;
        font-weight:600;
    }

    .modern-input{
        height:58px;
        border-radius:16px;
        border:none;
        padding:15px 20px;
        font-size:16px;
        background:rgba(255,255,255,0.12);
        color:white;
    }

    .modern-input::placeholder{
        color:#cbd5e1;
    }

    .modern-input:focus{
        background:rgba(255,255,255,0.18);
        box-shadow:none;
        border:1px solid #60a5fa;
        color:white;
    }

    .start-btn{
        height:55px;
        border:none;
        border-radius:16px;

        background:linear-gradient(135deg,#3b82f6,#2563eb);

        color:white;

        font-size:16px;
        font-weight:600;

        transition:.3s;
    }

    .start-btn:hover{
        transform:translateY(-2px);
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
    }

    .alert{
        border-radius:14px;
    }

    @keyframes fadeIn{
        from{
            opacity:0;
            transform:translateY(20px);
        }

        to{
            opacity:1;
            transform:translateY(0);
        }
    }

</style>

<div class="exam-wrapper">

    <div class="exam-box">

        <!-- Exam Info -->
        <div class="text-center">

            <h2 class="exam-title">
                {{ $exam->title }}
            </h2>

            <p class="exam-desc">
                {{ $exam->description }}
            </p>

        </div>

        <!-- Passkey Title -->
        <h5 class="passkey-title">
            🔐 Enter Exam Passkey
        </h5>

        <!-- Error -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('exam.check') }}">
            @csrf

            <input type="hidden"
                   name="exam_id"
                   value="{{ $exam->id }}">

            <div class="mb-4">

                <input type="password"
                       name="passkey"
                       placeholder="Enter Passkey"
                       class="form-control modern-input"
                       required>

            </div>

            <button class="btn start-btn w-100">
                Start Exam →
            </button>

        </form>

    </div>

</div>

@endsection