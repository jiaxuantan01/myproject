<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <style>

        body{
            margin:0;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f4f6f9;
            font-family:Arial, Helvetica, sans-serif;
        }

        .login-card{
            width:360px;
            background:white;
            padding:35px;
            border-radius:10px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }

        .login-title{
            text-align:center;
            font-size:22px;
            margin-bottom:25px;
            font-weight:600;
        }

        .input-group{
            margin-bottom:15px;
        }

        input{
            width:100%;
            padding:10px;
            border:1px solid #ddd;
            border-radius:5px;
            font-size:14px;
        }

        input:focus{
            outline:none;
            border-color:#4a90e2;
        }

        button{
            width:100%;
            padding:11px;
            border:none;
            background:#4a90e2;
            color:white;
            font-size:15px;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#357bd8;
        }

        .error{
            background:#ffe6e6;
            color:#cc0000;
            padding:8px;
            border-radius:5px;
            margin-bottom:15px;
            text-align:center;
        }

    </style>

</head>

<body>

<div class="login-card">

    <div class="login-title">
        Admin Login
    </div>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login_process') }}">
        @csrf

        <div class="input-group">
            <input type="text" name="name" placeholder="Username" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">
            Login
        </button>

    </form>

</div>

</body>
</html>
