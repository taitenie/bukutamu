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

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
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
            margin: 0;
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
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
            align-items: center;
        }

        .navbar .nav-item {
            position: relative;
            margin: 0 40px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: block;
            padding: 5px 0;
        }

        .navbar .sign-in {
            background-color: #8E90F6;
            padding: 8px 15px;
            border-radius: 20px;
            margin: 0;
        }

        a {
            color: black;
            text-decoration: none;
        }

        .footer-container a:hover {
            color: #0033A0;
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
            position: absolute;
            background-color: #002c8b;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            border-radius: 8px;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            pointer-events: none;
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
            white-space: nowrap;
        }

        .dropdown-content a:hover {
            background-color: #003d9f;
            border-radius: 4px;
            margin: 0 8px;
        }

        /* Show dropdown saat hover */
        .dropdown.show .dropdown-content {
            opacity: 1;
            visibility: visible;
            pointer-events: all;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-container img {
            height: 50px;
            margin-right: 10px;
        }

        .logo {
            width: 250px;
            height: auto;
            display: block;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 40px 20px;
        }

        h2 {
            text-align: center;
            color: #00218D;
            font-size: 36px;
            margin-top: 60px;
            margin-bottom: 10px;
        }

        .contact-section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .map-container {
            flex: 1;
            min-width: 300px;
            margin-top: 10px;
            border: 2px solid #3F5BBC;
            border-radius: 10px;
            overflow: hidden;
        }

        iframe {
            width: 550px;
            height: 350px;
            border: none;
            border-radius: 10px;
        }

        .contact-container {
            background-color: #3F5BBC;
            padding: 20px;
            border-radius: 12px;
            max-width: 100%;
            width: 500px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px 0;
            color: white;
        }

        .contact-item .icon img {
            width: 35px;
            height: 35px;
        }

        .contact-text h3 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            padding-left: 15px;
            padding-top: 3px;
        }

        .contact-text p {
            margin: 5px 0 0;
            font-size: 14px;
            padding-left: 15px;
        }

        .icon {
            width: 20px;
            height: 20px;
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
            <div class="nav-item">
                <a href="{{ route('home') }}">Home</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('home') }}">Form</a>
            </div>
            <div class="nav-item dropdown" id="layananDropdown">
                <a href="#" class="dropdown-toggle">Layanan</a>
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
            <div class="nav-item">
                <a href="{{ route('contact') }}">Kontak</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('survey.welcome') }}">Survey</a>
            </div>
        </div>
        <a href="{{ route('admin.login') }}" class="sign-in">Sign In</a>
    </div>

    <div class="container fade-in-up">
        <h2>Kontak Kami</h2>
        <div class="contact-section">
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8551094179375!2d112.74251500000001!3d-7.257326000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f968116a17af%3A0xe2a201af92736752!2sDinas%20Pendidikan%20Provinsi%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1741745068378!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="contact-container">
                <div class="contact-item">
                    <div class="icon">
                        <img src="/images/telfon.png" alt="Icon Telepon">
                    </div>
                    <div class="contact-text">
                        <h3>Hotline</h3>
                        <p>WhatsApp 0811-3110-8881</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon">
                        <img src="/images/email.png" alt="Icon Email">
                    </div>
                    <div class="contact-text">
                        <h3>Email</h3>
                        <p>dindik@jatimprov.go.id // ppidhumas.dindikjatim@gmail.com</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon">
                        <img src="/images/lokasi.png" alt="Icon Lokasi">
                    </div>
                    <div class="contact-text">
                        <h3>Kantor Dindik Jatim</h3>
                        <p>Jl. Gentengkali No.33 Kota Surabaya, 60275</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon">
                        <img src="/images/jam.png" alt="Icon Jam">
                    </div>
                    <div class="contact-text">
                        <h3>Jam Layanan</h3>
                        <p>Senin - Jumat : 08.00 - 15.00<br>Istirahat : 12.00 - 13.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div id="footer" class="footer-container">
            <div class="footer-logo">
                <img src="/images/logo footer.png" alt="Logo Dinas Pendidikan Jawa Timur">
            </div>

            <div class="footer-menu">
                <h4 style="text-decoration: underline;"">Our Menu</h4>
                <ul>
                    <li><a href=" {{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('home') }}">Form</a></li>
                    <li><a href="#">Layanan</a></li>
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