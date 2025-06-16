<!DOCTYPE html>
<html>
<head>
    <title>Terima Kasih</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="/images/logo_tab.png">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .thankyou-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }

        .thankyou-card h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .thankyou-card p {
            font-size: 1.2rem;
            color: #34495e;
        }

        .btn-primary {
            padding: 10px 30px;
            font-size: 1rem;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1d6fa5;
        }
    </style>

    <script>
        // Redirect ke /survey dalam 3.5 detik
        setTimeout(function () {
            window.location.href = "/";
        }, 2000);
    </script>
</head>
<body>
    <div class="thankyou-card">
        <h1>🎉 Terima Kasih!</h1>
        <p>Jawaban Anda telah berhasil dikirim.</p>
    </div>
</body>
</html>
