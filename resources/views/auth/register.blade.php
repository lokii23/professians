<x-guest-layout>

<style>

.register-box{

    max-width:780px;
    width:100%;

    margin:auto;

    padding:45px;

    border-radius:30px;

    background:white;

    border:1px solid #e2e8f0;

    box-shadow:
    0 20px 50px rgba(0,0,0,.06);

    animation:fadeUp .7s ease;
}

/* LOGO */

.register-logo{

    width:85px;

    animation:pulse 2s infinite;
}

/* TITLE */

.register-title{

    font-size:34px;

    font-weight:800;

    color:#0f172a;
}

.register-subtitle{

    color:#64748b;

    margin-top:8px;
}

/* INPUT GROUP */

.modern-group{

    border-radius:16px;

    overflow:hidden;

    border:1px solid #dbe3ee;

    transition:.3s ease;

    background:white;
}

.modern-group:focus-within{

    border-color:#2563eb;

    box-shadow:
    0 0 0 4px rgba(37,99,235,.12);
}

.input-group-text{

    background:white;

    border:none;

    padding-left:16px;

    font-size:18px;
}

.modern-input{

    border:none !important;

    box-shadow:none !important;

    height:50px;

    font-size:15px;
}

/* SELECT */

.modern-select{

    border:none !important;

    box-shadow:none !important;

    height:50px;
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

/* DIVIDER */

.custom-divider{

    border-top:1px solid #e2e8f0;

    margin:30px 0;
}

/* ANIMATION */

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

/* MOBILE */

@media(max-width:1200px){

    .auth-right{

        min-width:100%;
    }

    .register-box{

        max-width:100%;
    }

}

        .form-label{

            font-size:14px;

            margin-bottom:8px;
        }
</style>

<div class="register-box">

    <!-- HEADER -->

    <div class="text-center mb-4">

        <img src="/pap2.png"
             class="register-logo mb-3">

        <h2 class="register-title">

            Create Account

        </h2>

        <p class="register-subtitle">

            Register to access the examination system

        </p>

    </div>

    <!-- FORM -->

    <form method="POST"
          action="{{ route('register') }}">

        @csrf

        <!-- NAME -->

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    First Name

                </label>

                <div class="input-group modern-group">


                    <input type="text"
                           name="first_name"
                           value="{{ old('first_name') }}"
                           class="form-control modern-input"
                           placeholder="First Name"
                           required>

                </div>

                @error('first_name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Middle Name

                </label>

                <div class="input-group modern-group">


                    <input type="text"
                           name="middle_name"
                           value="{{ old('middle_name') }}"
                           class="form-control modern-input"
                           placeholder="Middle Name"
                           >

                </div>

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Last Name

                </label>

                <div class="input-group modern-group">


                    <input type="text"
                           name="last_name"
                           value="{{ old('last_name') }}"
                           class="form-control modern-input"
                           placeholder="Last Name"
                           required>

                </div>

            </div>

        </div>

        <!-- EMAIL + CONTACT -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Email Address

                </label>

                <div class="input-group modern-group">

                    <span class="input-group-text">

                        ✉️

                    </span>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control modern-input"
                           placeholder="Enter Email"
                           required>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Contact Number

                </label>

                <div class="input-group modern-group">

                    <span class="input-group-text">

                        📱

                    </span>

                    <input type="text"
                           name="contact_number"
                           value="{{ old('contact_number') }}"
                           class="form-control modern-input"
                           placeholder="Contact Number"
                           required>

                </div>

            </div>

        </div>

        <!-- GENDER + BIRTHDAY -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Gender

                </label>

                <div class="input-group modern-group">

                    <span class="input-group-text">

                        ⚧️

                    </span>

                    <select name="gender"
                            class="form-select modern-select"
                            required>

                        <option value="">
                            Select Gender
                        </option>

                        <option value="Male">
                            Male
                        </option>

                        <option value="Female">
                            Female
                        </option>

                    </select>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Birthday

                </label>

                <div class="input-group modern-group">

                    <span class="input-group-text">

                        🎂

                    </span>

                    <input type="date"
                           name="birthday"
                           value="{{ old('birthday') }}"
                           class="form-control modern-input"
                           required>

                </div>

            </div>

        </div>

        <!-- COURSE -->

        <div class="mb-3">

            <label class="form-label fw-semibold">

                Course & Section

            </label>

            <div class="input-group modern-group">

                <span class="input-group-text">

                    🎓

                </span>

                <select name="course"
                        class="form-select modern-select"
                        required>

                    <option value="">
                        Select Course & Section
                    </option>

                    <option value="BSHM3A">BSHM - 3A</option>
                    <option value="BSHM3B">BSHM - 3B</option>
                    <option value="BSTM3A">BSTM - 3A</option>
                    <option value="BSED1A">BSED - 1A</option>
                    <option value="BSIT1A">BSIT - 1A</option>
                    <option value="BSIT1B">BSIT - 1B</option>
                    <option value="BSIT2A">BSIT - 2A</option>
                    <option value="BSIT2B">BSIT - 2B</option>
                    <option value="BSIT3A">BSIT - 3A</option>
                    <option value="BSIT3B">BSIT - 3B</option>
                    <option value="BSIT4A">BSIT - 4A</option>
                    <option value="BSIT4B">BSIT - 4B</option>

                </select>

            </div>

        </div>

        <div class="custom-divider"></div>

        <!-- PASSWORD -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">
                    Password
                </label>

                <div class="input-group modern-group">

                    <span class="input-group-text">
                        🔒
                    </span>

                    <input type="password"
                        id="password"
                        name="password"
                        class="form-control modern-input"
                        placeholder="Enter Password"
                        required>

                    <button type="button"
                            class="input-group-text"
                            onclick="togglePassword('password', this)">
                        👁️
                    </button>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">
                    Confirm Password
                </label>

                <div class="input-group modern-group">

                    <span class="input-group-text">
                        🔐
                    </span>

                    <input type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control modern-input"
                        placeholder="Confirm Password"
                        required>

                    <button type="button"
                            class="input-group-text"
                            onclick="togglePassword('password_confirmation', this)">
                        👁️
                    </button>

                </div>

            </div>

        </div>

        <!-- BUTTON -->

        <button class="btn btn-modern w-100 mt-3">

            Create Account

        </button>

        <p class="text-center mt-4 text-muted">

            Already have an account?

            <a href="{{ route('login') }}"
               class="fw-semibold text-decoration-none">

                Login Here

            </a>

        </p>

    </form>

</div>
<script>

function togglePassword(id, btn)
{
    let input = document.getElementById(id);

    if (input.type === "password")
    {
        input.type = "text";
        btn.innerHTML = "🙈";
    }
    else
    {
        input.type = "password";
        btn.innerHTML = "👁️";
    }
}

</script>
</x-guest-layout>