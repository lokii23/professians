<x-guest-layout>

<div class="auth-box">

    <!-- HEADER -->

    <div class="text-center mb-4">

        <img src="/pap2.png"
             class="login-logo mb-3">

        <h2 class="fw-bold login-title">

            Welcome Back

        </h2>

        <p class="text-muted">

            Login to continue to your dashboard

        </p>

    </div>

    <!-- ALERT -->

    @if(session('status'))

        <div class="alert alert-success rounded-4">

            {{ session('status') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger rounded-4">

            {{ $errors->first() }}

        </div>

    @endif

    <!-- FORM -->

    <form method="POST"
          action="{{ route('login') }}"
          onsubmit="showSplash()">

        @csrf

        <!-- EMAIL -->

        <div class="mb-3">

            <label class="form-label fw-semibold">

                Email Address

            </label>

            <div class="input-group modern-group">

                <span class="input-group-text">

                    ✉️

                </span>

                <input type="email"
                       name="email"
                       class="form-control modern-input"
                       placeholder="Enter your email"
                       required>

            </div>

        </div>

        <!-- PASSWORD -->

        <div class="mb-4">

            <label class="form-label fw-semibold">

                Password

            </label>

            <div class="input-group modern-group">

                <span class="input-group-text">

                    🔒

                </span>

                <input type="password"
                       name="password"
                       class="form-control modern-input"
                       placeholder="Enter your password"
                       required>

            </div>

        </div>

        <!-- BUTTON -->

        <button type="submit"
                class="btn btn-modern w-100">

            Login Now

        </button>

    </form>

</div>

<!-- SPLASH SCREEN -->

<div id="loginSplash"
     class="splash-screen d-none">

    <div class="splash-circle one"></div>
    <div class="splash-circle two"></div>

    <div class="splash-content">

        <div class="logo-wrapper">

            <img src="/pap2.png"
                 class="splash-logo">

        </div>

        <h1 class="splash-title">

            PROFESSIANS

        </h1>

        <p class="splash-subtitle">

            Loading your dashboard...

        </p>

        <div class="loading-bar">

            <div class="loading-progress"></div>

        </div>

    </div>

</div>

<style>

/* LOGIN BOX */

.auth-box{

    animation:fadeUp .7s ease;
}

/* LOGO */

.login-logo{

    width:85px;
    display:block;
    margin:0 auto;
    animation:pulse 2s infinite;
}

.login-title{

    color:#0f172a;
}

/* INPUT */

.modern-group{

    border-radius:16px;

    overflow:hidden;

    border:1px solid #dbe3ee;

    transition:.3s ease;
}

.modern-group:focus-within{

    border-color:#2563eb;

    box-shadow:
    0 0 0 4px rgba(37,99,235,.12);
}

.input-group-text{

    background:white;

    border:none;

    padding-left:18px;

    font-size:18px;
}

.modern-input{

    border:none !important;

    box-shadow:none !important;
}

/* BUTTON */

.btn-modern{

    height:55px;

    border:none;

    border-radius:16px;

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );

    color:white;

    font-weight:700;

    transition:.3s ease;
}

.btn-modern:hover{

    transform:translateY(-2px);

    color:white;

    box-shadow:
    0 12px 25px rgba(37,99,235,.25);
}

/* SPLASH */

.splash-screen{

    position:fixed;
    inset:0;

    background:
    linear-gradient(
        135deg,
        #0f172a,
        #111827,
        #1e293b
    );

    display:flex;
    align-items:center;
    justify-content:center;

    overflow:hidden;

    z-index:999999;
}

/* CIRCLES */

.splash-circle{

    position:absolute;

    border-radius:50%;

    filter:blur(100px);

    opacity:.25;
}

.splash-circle.one{

    width:320px;
    height:320px;

    background:#2563eb;

    top:-100px;
    left:-100px;
}

.splash-circle.two{

    width:360px;
    height:360px;

    background:#60a5fa;

    bottom:-100px;
    right:-100px;
}

/* CONTENT */

.splash-content{

    position:relative;
    z-index:5;

    text-align:center;
}

/* LOGO */

.logo-wrapper{

    width:130px;
    height:130px;

    border-radius:50%;

    background:
    rgba(255,255,255,.08);

    backdrop-filter:blur(15px);

    display:flex;
    align-items:center;
    justify-content:center;

    margin:auto;

    animation:pulse 2s infinite;

    box-shadow:
    0 0 40px rgba(59,130,246,.35);
}

.splash-logo{

    width:75px;
}

/* TEXT */

.splash-title{

    color:white;

    font-size:38px;
    font-weight:800;

    letter-spacing:3px;

    margin-top:28px;
}

.splash-subtitle{

    color:rgba(255,255,255,.75);

    margin-bottom:30px;
}

/* LOADER */

.loading-bar{

    width:280px;
    height:10px;

    margin:auto;

    background:
    rgba(255,255,255,.08);

    border-radius:30px;

    overflow:hidden;
}

.loading-progress{

    height:100%;

    border-radius:30px;

    background:
    linear-gradient(
        90deg,
        #2563eb,
        #60a5fa
    );

    animation:loading 2s infinite;
}

/* ANIMATION */

@keyframes loading{

    0%{
        width:0%;
    }

    50%{
        width:70%;
    }

    100%{
        width:100%;
    }
}

@keyframes pulse{

    0%{
        transform:scale(1);
    }

    50%{
        transform:scale(1.05);
    }

    100%{
        transform:scale(1);
    }
}

@keyframes fadeUp{

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

<script>

function showSplash()
{
    document
        .getElementById('loginSplash')
        .classList
        .remove('d-none');
}

</script>

</x-guest-layout>