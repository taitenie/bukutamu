<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dindik Jatim</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/images/logo_tab.png">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: white;
            color: #00218D;
            text-align: center;
            margin: 0;
            padding: 10px;
        }

        .navbar {
            background-color: #00218D;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            font-weight: bold;
            box-sizing: border-box;
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar .nav-links {
            display: flex;
            flex-grow: 1;
            justify-content: center;
            position: relative;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 40px;
            font-size: 16px;
            position: relative;
        }


        /* Dropdown Container - PERBAIKAN UTAMA */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Area invisible untuk jembatan hover */
        .dropdown::after {
            content: '';
            position: absolute;
            top: 100%;
            left: -20px;
            right: -20px;
            height: 15px;
            background: transparent;
            z-index: 999;
        }


        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #002c8b;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            border-radius: 8px;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 0;
            margin-top: 10px;
            text-align: left;
            /* PERBAIKAN: Tambahkan ini untuk rata kiri */
        }

        /* Arrow untuk dropdown */
        .dropdown-content::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid #002c8b;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            margin: 0;
            font-size: 14px;
            transition: background-color 0.3s;
            text-align: left;
            /* PERBAIKAN: Tambahkan ini juga untuk memastikan */
        }

        .dropdown-content a:hover {
            background-color: #003d9f;
            border-radius: 4px;
            margin: 0 8px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Show dropdown saat hover */
        .dropdown.show .dropdown-content {
            opacity: 1;
            visibility: visible;
            pointer-events: all;
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .navbar .sign-in {
            background-color: #8E90F6;
            padding: 8px 15px;
            border-radius: 20px;
        }

        a {
            color: black;
            text-decoration: none;
        }

        .footer-container a:hover {
            color: #0033A0;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-container img {
            height: 50px;
            margin-right: 10px;
        }

        .text-container {
            margin-left: 120px;
        }

        .title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #00218D;
            margin-top: 100px;
        }

        .survey-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin: 40px auto;
            padding: 0 20px;
            max-width: 1000px;
        }

        .form-container {
            position: relative;
            background-color: #475FCB;
            border-radius: 15px;
            padding: 40px 40px 40px 80px;
            /* kiri 80px agar intro box bisa overlap */
            color: white;
            flex: 1;
            max-width: 400px;
            width: 100%;
        }

        .intro-box {
            position: absolute;
            top: 40px;
            left: 90px;
            /* keluar sedikit dari form */
            background-color: #FFF59D;
            width: 200px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
            /* ini penting agar intro box muncul di atas */
        }

        .intro-box h3 {
            color: #00218D;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .intro-box p {
            color: #2E2E2E;
            font-size: 14px;
            line-height: 1.5;
        }

        .form-container label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            margin-bottom: 16px;
            font-size: 14px;
            background-color: #ffffff;
            color: #333;
            box-sizing: border-box;
        }

        .form-row {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .form-row .form-group {
            flex: 1;
        }

        .submit-btn-inline {
            background-color: #00218D;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.3s, transform 0.2s;
        }

        @media screen and (max-width: 768px) {
            .form-row {
                flex-direction: column;
                align-items: stretch;
            }

            .submit-btn {
                width: 100%;
            }
        }

        @media screen and (max-width: 768px) {
            .survey-wrapper {
                flex-direction: column;
                align-items: center;
            }
        }

        footer {
            background: white;
            padding: 20px;
            font-family: Arial, sans-serif;
            text-align: left;
        }

        /* Container Utama Footer */
        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            /* Biar responsif di layar kecil */
            gap: 20px;
        }

        /* Logo di Footer */
        .footer-logo {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .footer-logo img {
            width: 300px;
            /* Ukuran logo lebih proporsional */
            margin-bottom: 10px;
            padding-top: 35px;
        }

        /* Style untuk Menu, Kontak, dan Sosial Media */
        .footer-menu,
        .footer-contact,
        .footer-social {
            flex: 0 0 250px;
        }

        /* Judul di Menu dan Kontak */
        .footer-menu h4,
        .footer-contact h4,
        .footer-social h4 {
            color: #0033A0;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* List Menu */
        .footer-menu ul {
            list-style: none;
            padding: 0;
            font-size: 14px;
        }

        .footer-menu ul li {
            margin-bottom: 8px;
        }


        /* Style untuk Kontak & Sosial Media */
        .footer-contact p {
            margin: 5px 0;
            color: black;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .footer-social p {
            margin: 5px 0;
            color: black;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            white-space: nowrap;
            line-height: 1.4;
        }

        .footer-social p span {
            word-break: break-word;
            font-size: 14px;
        }

        /* Style untuk Ikon */
        .footer-social p img {
            width: 20px;
            /* Ukuran ikon */
            height: 20px;
            vertical-align: middle;
            /* Tambahkan ini */
            flex-shrink: 0;
            /* Biar tidak mengecil kalau sempit */
            margin-bottom: 5px;
        }

        /* Garis Pembatas */
        .footer-line {
            border: none;
            border-top: 2px solid orange;
            margin: 10px 0;
        }

        /* Bagian Bawah Footer */
        .footer-bottom {
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo-container">
            <img src="/images/logo header.png" alt="Logo Dindik">
        </div>
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}">Form</a>
            <div class="dropdown">
                <a href="#">Layanan</a>
                <div class="dropdown-content">
                    <a href="https://www.lapor.go.id/">Pengaduan</a>
                    <a href="https://dindik.jatimprov.go.id/pages/sekretariat">Sekretariat</a>
                    <a href="https://dindik.jatimprov.go.id/pages/bidang-sma">Bidang SMA</a>
                    <a href="https://dindik.jatimprov.go.id/pages/bidang-smk">Bidang SMK</a>
                    <a href="https://pkplk.dindikjatim.id/">Bidang PK-PLK</a>
                    <a href="https://dindik.jatimprov.go.id/pages/bidang-gtk">Bidang GTK</a>
                    <a href="https://dindik.jatimprov.go.id/pages/upt-tikp">UPT TIKP</a>
                    <a href="https://dindik.jatimprov.go.id/pages/upt-ptkk">UPT PTKK</a>
                </div>
            </div>
            <a href="{{ route('contact') }}">Kontak</a>
            <a href="{{ route('survey.welcome') }}">Survey</a>
        </div>
        <a href="{{ route('login') }}" class="sign-in">Sign In</a>
    </div>

    <h2 class="title">Survey Kepuasan Masyarakat</h2>

    <div class="survey-wrapper fade-in-up">
        <!-- Box Kiri -->
        <div class="intro-box">
            <h3>Selamat Datang!</h3>
            <p>Hasil dari survei ini akan digunakan untuk meningkatkan kualitas Dinas Pendidikan Provinsi Jawa Timur.
                Mohon untuk mengisi dengan sebenar-benarnya.</p>
        </div>

        @if (session('error'))
            <div style="color: red; font-weight: bold; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Kanan -->
        <div class="form-container">
            <form class="visitor-form" method="POST" action="{{ route('survey.start') }}">
                @csrf
                <input type="text" name="nama" placeholder="Nama Pengunjung" required>
                <input type="number" name="umur" placeholder="Umur Pengunjung" min="10" max="100" required>
                <input type="tel" name="no_hp" pattern="[0-9]{10,15}" placeholder="Nomor Handphone" required>

                <!-- Baris Jenis Kelamin + Submit -->
                <div class="form-row">
                    <div class="form-group">
                        <select name="jenis_kelamin" required>
                            <option value="" disabled selected>Jenis Kelamin Pengunjung</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="submit-btn-inline">Lanjut</button>
            </form>
        </div>
    </div>

    <footer>
        <div id="footer" class="footer-container">
            <div class="footer-logo">
                <img src="/images/logo footer.png" alt="Logo Dinas Pendidikan Jawa Timur">
            </div>

            <div class="footer-menu">
                <h4 style="text-decoration: underline">Our Menu</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('home') }}">Form</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                    <li><a href="{{ route('survey.welcome') }}">Survey</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4 style="text-decoration: underline;">Contact Us</h4>
                <p>
                    Jl. Genteng Kali No.33,
                    Surabaya
                </p>
                <p>
                    ppidhumas.dindikjatim@gmail.com
                </p>
                <p>
                    0811-3110-8881
                </p>
                <p>
                    Lapor.go.id
                </p>
            </div>

            <div class="footer-social">
                <h4>Social Media</h4>

                <p>
                    <a href="https://www.instagram.com/dindik_jatim" target="_blank" rel="noopener noreferrer">
                        <img src="/images/icon-ig.png" alt="Icon Instagram" width="20"> @dindik_jatim
                    </a>
                </p>

                <p>
                    <a href="https://www.facebook.com/Dindik.Jatim" target="_blank" rel="noopener noreferrer">
                        <img src="/images/icon-fb.png" alt="Icon Facebook" width="20"> Dindik.Jatim
                    </a>
                </p>

                <p>
                    <a href="hhttps://x.com/Dindik_Jatim" target="_blank" rel="noopener noreferrer">
                        <img src="/images/icon-x.png" alt="Icon X" width="20"> @Dindik_Jatim
                    </a>
                </p>

                <p>
                    <a href="https://www.youtube.com/c/DinasPendidikanProvinsiJawaTimur" target="_blank"
                        rel="noopener noreferrer">
                        <img src="/images/icon-yt.png" alt="Icon YouTube" width="20"> Dinas Pendidikan Provinsi Jawa
                        Timur
                    </a>
                </p>
            </div>
        </div>

        <hr class="footer-line">

        <p class="footer-bottom" style="color: black">© 2025 Dinas Pendidikan Provinsi Jawa Timur</p>
    </footer>

    <script>
        // JavaScript untuk kontrol dropdown yang lebih stabil
        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.getElementById('layananDropdown');
            const dropdownContent = dropdown.querySelector('.dropdown-content');
            let hoverTimeout;
            let isHovering = false;

            function showDropdown() {
                clearTimeout(hoverTimeout);
                isHovering = true;
                dropdown.classList.add('show');
            }

            function hideDropdown() {
                isHovering = false;
                hoverTimeout = setTimeout(() => {
                    if (!isHovering) {
                        dropdown.classList.remove('show');
                    }
                }, 150); // Delay 150ms sebelum menutup
            }

            // Event listeners untuk dropdown container
            dropdown.addEventListener('mouseenter', function () {
                showDropdown();
            });

            dropdown.addEventListener('mouseleave', function () {
                hideDropdown();
            });

            // Event listeners untuk dropdown content
            dropdownContent.addEventListener('mouseenter', function () {
                showDropdown();
            });

            dropdownContent.addEventListener('mouseleave', function () {
                hideDropdown();
            });

            // Mencegah link default behavior
            dropdown.querySelector('.dropdown-toggle').addEventListener('click', function (e) {
                e.preventDefault();
                if (dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                } else {
                    showDropdown();
                }
            });

            // Tutup dropdown saat klik di luar
            document.addEventListener('click', function (e) {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });
        });
    </script>

</body>

</html>