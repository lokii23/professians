<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PROFESSIANS | CCS</title>
    <link rel="icon" href="/pap1.png">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            overflow:hidden;
            background:#0f172a;
        }

        /* HERO */
        .hero{

            width:100%;
            height:100vh;

            background:
                url("{{ asset('BG.jpg') }}");

            background-size:cover;
            background-position:center;

            display:flex;
            justify-content:center;
            align-items:center;

            position:relative;

            overflow:hidden;
        }

        /* DARK OVERLAY GLOW */
        .hero::before{

            content:'';

            position:absolute;

            width:700px;
            height:700px;

            background:radial-gradient(
                circle,
                rgba(59,130,246,0.25),
                transparent 70%
            );

            top:-200px;
            right:-200px;

            animation:pulseGlow 6s ease-in-out infinite;
        }

        @keyframes pulseGlow{

            0%{
                transform:scale(1);
                opacity:.5;
            }

            50%{
                transform:scale(1.15);
                opacity:.9;
            }

            100%{
                transform:scale(1);
                opacity:.5;
            }
        }

        /* FLOATING PARTICLES */
        .particle{

            position:absolute;

            width:8px;
            height:8px;

            background:#3b82f6;

            border-radius:50%;

            box-shadow:0 0 20px #3b82f6;

            animation:float 10s linear infinite;
        }

        .particle:nth-child(1){
            left:10%;
            animation-duration:10s;
        }

        .particle:nth-child(2){
            left:25%;
            animation-duration:7s;
        }

        .particle:nth-child(3){
            left:40%;
            animation-duration:12s;
        }

        .particle:nth-child(4){
            left:65%;
            animation-duration:8s;
        }

        .particle:nth-child(5){
            left:85%;
            animation-duration:11s;
        }

        @keyframes float{

            from{
                transform:translateY(100vh);
                opacity:0;
            }

            30%{
                opacity:1;
            }

            to{
                transform:translateY(-100px);
                opacity:0;
            }
        }

        /* CONTENT */
        .content{

            position:relative;

            z-index:2;

            text-align:center;

            padding:20px;
        }


        /* BUTTON */
        .vote-btn{
            margin-top:500px;
            display:inline-flex;

            align-items:center;
            justify-content:center;
            gap:10px;

            padding:16px 34px;

            border-radius:50px;

            text-decoration:none;

            color:white;

            font-size:18px;
            font-weight:600;

            background:linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            box-shadow:
                0 0 25px rgba(37,99,235,.5);

            transition:.35s ease;

            position:relative;

            overflow:hidden;
        }

        .vote-btn:hover{

            transform:translateY(-4px) scale(1.03);

            box-shadow:
                0 0 45px rgba(37,99,235,.8);
        }

        .vote-btn::before{

            content:'';

            position:absolute;

            top:0;
            left:-120%;

            width:100%;
            height:100%;

            background:rgba(255,255,255,.18);

            transform:skewX(-30deg);

            transition:.7s;
        }

        .vote-btn:hover::before{

            left:130%;
        }

        /* MOBILE */
        @media(max-width:768px){

            .title{

                font-size:45px;
            }

            .subtitle{

                font-size:12px;

                letter-spacing:3px;
            }

            .vote-btn{

                width:100%;

                max-width:280px;

                font-size:16px;
            }
        }

    </style>

</head>

<body>

<div class="hero">

    <!-- PARTICLES -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <!-- CONTENT -->
    <div class="content">
        

        <a href="/login" class="vote-btn">
            🔐 LOGIN →
        </a>

    </div>

</div>

</body>
</html>