<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>PROFESSIANS | Login</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <link rel="icon" href="/pap1.png">

    <!-- GOOGLE FONT -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- BOOTSTRAP -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family:'Poppins',sans-serif;

            overflow-y:auto;

            background:#f8fafc;
        }

        /* MAIN */

        .auth-container{
            display:flex;

            min-height:100vh;

            overflow-y:auto;
        }

        /* LEFT SIDE */

        .auth-left{

            flex:1;

            position:relative;

            overflow:hidden;

            display:flex;
            align-items:center;
            justify-content:center;

            background:
            linear-gradient(
                135deg,
                #0f172a,
                #1e3a8a,
                #2563eb
            );

            padding:60px;
        }

        /* GLOW EFFECT */

        .auth-left::before{

            content:'';

            position:absolute;

            width:450px;
            height:450px;

            background:
            rgba(255,255,255,.08);

            border-radius:50%;

            top:-120px;
            left:-120px;

            filter:blur(10px);
        }

        .auth-left::after{

            content:'';

            position:absolute;

            width:350px;
            height:350px;

            background:
            rgba(255,255,255,.05);

            border-radius:50%;

            bottom:-100px;
            right:-100px;
        }

        /* LEFT CONTENT */

        .left-content{

            position:relative;
            z-index:5;

            max-width:520px;

            color:white;
        }

        .college-badge{

            display:inline-block;

            background:
            rgba(255,255,255,.12);

            backdrop-filter:blur(10px);

            padding:10px 18px;

            border-radius:50px;

            font-size:14px;
            font-weight:600;

            margin-bottom:25px;

            border:1px solid rgba(255,255,255,.12);
        }

        .left-content h1{

            font-size:55px;

            font-weight:800;

            line-height:1.1;

            margin-bottom:20px;
        }

        .highlight{

            color:#facc15;
        }

        .left-content p{

            font-size:18px;

            opacity:.88;

            line-height:1.7;
        }

        /* FEATURES */

        .feature-list{

            margin-top:40px;
        }

        .feature-item{

            display:flex;
            align-items:center;

            gap:15px;

            margin-bottom:18px;

            font-size:16px;
            font-weight:500;
        }

        .feature-icon{

            width:42px;
            height:42px;

            border-radius:12px;

            background:
            rgba(255,255,255,.10);

            display:flex;
            align-items:center;
            justify-content:center;

            backdrop-filter:blur(10px);

            font-size:18px;
        }

        /* RIGHT SIDE */

        .auth-right{

            flex:1;

            min-width:720px;

            background:#f8fafc;

            display:flex;
            align-items:center;
            justify-content:center;

            padding:40px 60px;

            position:relative;

            overflow-y:auto;
        }
        .register-box{
            margin:40px 0;
        }
        /* LOGIN BOX */

        .auth-box{

            width:100%;
            max-width:420px;

            background:white;

            padding:40px;

            border-radius:28px;

            border:1px solid #e2e8f0;

            box-shadow:
            0 20px 50px rgba(0,0,0,.06);

            animation:fadeUp .7s ease;
        }

        /* INPUT */
        .form-control{

            height:55px;

            border-radius:16px;

            border:1px solid #dbe3ee;

            padding-left:18px;

            font-size:15px;

            transition:.3s ease;
        }

        .form-control:focus{

            border-color:#2563eb;

            box-shadow:
            0 0 0 4px rgba(37,99,235,.12);
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

        /* ANIMATION */

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

        @media(max-width:992px){

            .auth-left{
                display:none;
            }

            .auth-right{
                width:100%;
            }

            .auth-box{
                padding:35px 25px;
            }

        }

    </style>

</head>

<body>

<div class="auth-container">

    <!-- LEFT -->

    <div class="auth-left">

        <div class="left-content">

            <div class="college-badge">

                Professional Academy of the Philippines🎓 

            </div>

            <h1>

                College of <span class="highlight">Computer Studies</span>

            </h1>

            <p>

                A secure and modern system for managing online examinations,
                quizzes, and student assessments with speed and reliability.

            </p>

            <!-- FEATURES -->

            <div class="feature-list">

                <div class="feature-item">

                    <div class="feature-icon">

                        ⚡

                    </div>

                    Fast & Real-time Examination System

                </div>

                <div class="feature-item">

                    <div class="feature-icon">

                        🔒

                    </div>

                    Secure Student Authentication

                </div>

                <div class="feature-item">

                    <div class="feature-icon">

                        📊

                    </div>

                    Instant Quiz Results & Analytics

                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="auth-right">

        {{ $slot }}

    </div>

</div>

</body>

</html>