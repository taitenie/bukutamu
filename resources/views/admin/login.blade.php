<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/images/logo_tab.png">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('{{ asset('images/Login.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
        }

        .logo-container {
            width: 40%;
        }

        .logo {
            width: 100%;
            height: auto;
        }

        .sign-in-box {
            background: rgb(255, 255, 255);
            padding: 40px;
            border-radius: 30px;
            width: 35%;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }

        .sign-in-title {
            color: #00218D;
            font-size: 28px;
            font-weight: 800;
        }

        .sign-in-subtitle {
            color: #00218D;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .input-field {
            margin-bottom: 15px;
        }

        .input-field input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
        }

        .btn-sign-in {
            width: 100%;
            padding: 12px;
            background-color: #E98862;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-sign-in:hover {
            background-color: #d7744f;
            transform: scale(1.02);
        }

        .btn-sign-in:active {
            background-color: #c46543;
            transform: scale(0.98);
        }

        .btn-home {
            display: block;
            margin-top: 15px;
            text-align: center;
            background-color: transparent;
            color: #00218D;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s, transform 0.2s;
        }

        .btn-home:hover {
            color: #001b70;
            transform: scale(1.05);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <!-- Logo can be added here if needed -->
        </div>

<div class="sign-in-box">
    <h1 class="sign-in-title">Sign In</h1>
    <p class="sign-in-subtitle">Welcome back! Please login to your account</p>

    @if(session('error'))
        <div style="background-color: #ffdede; color: #a70000; border: 1px solid #f5c2c2; padding: 10px 15px; border-radius: 10px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="input-field">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-field">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn-sign-in">Sign In</button>
    </form>

    <a href="{{ route('home') }}" class="btn-home">← Kembali ke Beranda</a>
</div>
    </div>
</body>
</html>
