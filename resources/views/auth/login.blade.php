<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins', sans-serif;
            min-height:100vh;
            overflow:hidden;
            position:relative;
            background:
                linear-gradient(
                    135deg,
                    #042159 0%,
                    #005792 45%,
                    #0077B6 70%,
                    #F7931E 100%
                );
        }

        body::before{
            content:'';
            position:absolute;
            width:500px;
            height:500px;
            background:rgba(255,255,255,0.06);
            border-radius:50%;
            top:-180px;
            right:-150px;
            filter:blur(10px);
        }

        body::after{
            content:'';
            position:absolute;
            width:400px;
            height:400px;
            background:rgba(247, 147, 30, 0.18);
            border-radius:50%;
            bottom:-180px;
            left:-120px;
            filter:blur(20px);
        }

        .login-wrapper{
            width:100%;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
            position:relative;
            z-index:2;
        }

        .login-card{
            width:100%;
            max-width:430px;
            background:rgba(255,255,255,0.12);
            border:1px solid rgba(255,255,255,0.18);
            backdrop-filter:blur(18px);
            -webkit-backdrop-filter:blur(18px);
            padding:45px;
            border-radius:24px;
            box-shadow:
                0 10px 40px rgba(0,0,0,0.22),
                inset 0 1px 1px rgba(255,255,255,0.1);
            animation:fadeIn 0.7s ease;
        }

        @keyframes fadeIn{

            from{
                opacity:0;
                transform:translateY(25px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }

        }

        h2{
            text-align:center;
            color:#fff;
            font-size:32px;
            font-weight:700;
            margin-bottom:8px;
        }

        .subtitle{
            text-align:center;
            color:rgba(255,255,255,0.75);
            font-size:14px;
            margin-bottom:35px;
        }

        .form-group{
            margin-bottom:22px;
        }

        label{
            display:block;
            margin-bottom:10px;
            color:#fff;
            font-size:14px;
            font-weight:500;
        }

        .input-group{
            position:relative;
            transition:0.3s ease;
        }

        input{
            width:100%;
            padding:15px 18px;
            border:none;
            outline:none;
            border-radius:14px;
            background:rgba(255,255,255,0.14);
            color:#fff;
            font-size:15px;
            transition:0.3s ease;
            border:1px solid transparent;
        }

        input::placeholder{
            color:rgba(255,255,255,0.55);
        }

        input:focus{
            border:1px solid #F7931E;
            background:rgba(255,255,255,0.18);
            box-shadow:0 0 0 4px rgba(247,147,30,0.18);
        }

        button{
            width:100%;
            padding:15px;
            border:none;
            border-radius:14px;
            background:linear-gradient(
                135deg,
                #F7931E,
                #ff8c00
            );
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s ease;
            margin-top:10px;
            box-shadow:0 12px 25px rgba(247,147,30,0.35);
        }

        button:hover{
            transform:translateY(-2px);
            box-shadow:0 16px 30px rgba(247,147,30,0.45);
        }

        button:active{
            transform:scale(0.98);
        }

        .error{
            background:rgba(255, 82, 82, 0.18);
            color:#fff;
            padding:14px;
            margin-bottom:20px;
            border-radius:12px;
            border:1px solid rgba(255,255,255,0.12);
            font-size:14px;
        }

        .footer-text{
            text-align:center;
            color:rgba(255,255,255,0.65);
            margin-top:25px;
            font-size:13px;
        }

        @media(max-width:500px){

            .login-card{
                padding:35px 25px;
            }

            h2{
                font-size:26px;
            }

        }

    </style>

</head>
<body>

<div class="login-wrapper">

    <div class="login-card">

        <h2>Inventory System</h2>

        <p class="subtitle">
            Sign in to continue
        </p>

        @if(session('error'))

            <div class="error">
                {{ session('error') }}
            </div>

        @endif

        <form method="POST" action="{{ url('/login') }}">

            @csrf

            <div class="form-group">

                <label>Email Address</label>

                <div class="input-group">

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>

            </div>

            <div class="form-group">

                <label>Password</label>

                <div class="input-group">

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                </div>

            </div>

            <button type="submit">
                Login
            </button>

        </form>

        <div class="footer-text">
            © {{ date('Y') }} Inventory Management System
        </div>

    </div>

</div>

<script>

    const inputs = document.querySelectorAll('input');

    inputs.forEach(input => {

        input.addEventListener('focus', () => {
            input.parentElement.style.transform = 'scale(1.01)';
        });

        input.addEventListener('blur', () => {
            input.parentElement.style.transform = 'scale(1)';
        });

    });

</script>

</body>
</html>