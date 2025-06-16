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

        .fade-in-delay-1 {
            animation-delay: 0.3s;
        }

        .fade-in-delay-2 {
            animation-delay: 0.6s;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
            background-color: #f1f1f1;
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

        .hero {
            background: url('/images/foto dindik.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 60px 20px;
            display: flex;
            height: 70vh;
            justify-content: center;
            margin-top: 60px;
            border-radius: 10px;
        }

        .hero-content {
            display: flex;
            align-items: center;
            gap: 0px;
            text-align: left;
            padding: 20px;
            border-radius: 10px;
            max-width: 1200px;
            margin: auto;
        }

        .hero h1 {
            font-size: 50px;
            font-weight: 700;
            color: #00218D;
            margin: 5px 0;
        }

        .hero h2 {
            font-size: 28px;
            color: #FEEC77;
            font-weight: bold;
            margin: 5px 0;

        }

        .hero h3 {
            font-size: 18px;
            font-weight: 600;
            color: #00218D;
            margin: 5px 0;
        }

        .logo {
            width: 250px;
            height: auto;
            display: block;
            margin: 0;
            padding: 0;
        }

        .form-section {
            background: linear-gradient(to bottom, #002c8b, #3a5ec7);
            color: white;
            width: 80%;
            margin: 40px auto;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: left;
        }

        .form-section h2 {
            font-size: 28px;
            color: #FEEC77;
            font-weight: bold;
            margin: 5px 0;
            text-align: center;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 40px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 0;
        }

        .form-group {
            flex: 1;
            border: none;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            font-weight: bold;
            color: white;
        }

        input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: white;
        }

        fieldset legend {
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .form-left,
        .form-right {
            width: 50%;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        legend {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        select {
            color: gray;
        }

        select:focus,
        select:valid {
            color: black;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 200px;
            resize: vertical;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        fieldset {
            border: none;
            padding: 0;
            margin: 0;
        }

        .foto-container {
            border: 2px solid white;
            padding: 20px;
            text-align: center;
            width: 300px;
            border-radius: 10px;
        }

        .foto-container img {
            width: 50px;
            height: 50px;
            display: block;
            margin: 0 auto 10px;
        }

        .foto-container p {
            color: white;
            font-size: 14px;
            font-weight: bold;
        }

        .foto-container label {
            cursor: pointer;
            display: block;
            padding: 10px;
        }

        #video {
            width: 100%;
            border-radius: 5px;
            display: none;
        }

        .capture-btn {
            background-color: white;
            color: black;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            font-size: 14px;
            border-radius: 5px;
        }

        .capture-btn:hover {
            background-color: white;
        }

        canvas {
            display: none;
        }

        .submit-btn {
            width: 120px;
            margin-top: 20px;
            background-color: #00218D;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .note-text {
            font-size: 16px;
            font-style: italic;
            margin-top: 5px;
            display: block;
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

        #video {
            max-width: 100%;
            height: auto;
        }

        canvas {
            display: none;
        }

        .foto-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .capture-btn {
            padding: 8px 12px;
            background-color: #00218D;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .capture-btn:hover {
            background-color: #001866;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo-container">
            <img src="/images/logo header.png" alt="Logo Dindik">
        </div>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#form-section">Form</a>
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
        <a href="{{ route('admin.login') }}" class="sign-in">Sign In</a>
    </div>


    <div id="home" class="hero fade-in-up">
        <div class="hero-content">
            <img src="/images/logo dindik.png" alt="Logo Dindik" class="logo">
            <div class="text-container">
                <h1 class="fade-in-up fade-in-delay-1">Selamat Datang di</h1>
                <h1 class="fade-in-up fade-in-delay-1">Buku Tamu Elektronik</h1>
                <h2 class="fade-in-up fade-in-delay-2">DINAS PENDIDIKAN PROVINSI JAWA TIMUR</h2>
                <h3>Mewujudkan insan yang cerdas,
                    berakhlak, profesional dan berbudaya</h3>
            </div>
        </div>
    </div>
    <!-- Bagian Form -->
    <div id="form-section" class="form-section fade-in-up">
        <h2>Buku Tamu Dinas Pendidikan Jawa Timur</h2>
        <form class="form-container" action="{{ route('bukutamu.store') }}" method="POST">
            @csrf

            <!-- Kolom Kiri -->
            <div class="form-left">
                <label for="name">Nama:*</label>
                <input type="text" id="name" name="name" placeholder="Nama Pengunjung" required>

                <label for="nik">NIK:*</label>
                <input type="text" id="nik" name="nik" placeholder="NIK Pengunjung" required>

                <label for="phone">Nomor Handphone:*</label>
                <input type="text" id="phone" name="phone" placeholder="Nomor Pengunjung" required>

                <label for="pekerjaan">Pekerjaan:*</label>
                <select id="pekerjaan" name="pekerjaan" required>
                    <option value="" disabled selected>Pekerjaan Pengunjung</option>
                    <option value="Orang Tua / Wali Murid">Orang Tua / Wali Murid</option>
                    <option value="Siswa / Mahasiswa">Siswa / Mahasiswa</option>
                    <option value="Guru">Guru</option>
                    <option value="Swasta">Swasta</option>
                    <option value="Lainnya">Lainnya</option>
                </select>

                <label for="keperluan">Keperluan:*</label>
                <textarea id="keperluan" name="keperluan" required></textarea>

                <button type="submit" class="submit-btn">Submit</button>
            </div>

            <!-- Kolom Kanan -->
            <div class="form-right">
                <label for="alamat">Alamat:*</label>
                <input type="text" id="alamat" name="alamat" placeholder="Alamat Pengunjung" required>

                <div class="form-row">
                    <fieldset class="form-group">
                        <legend>Jenis Kelamin*</legend>
                        <label><input type="radio" name="gender" value="Perempuan" required> Perempuan</label>
                        <label><input type="radio" name="gender" value="Laki-laki" required> Laki-laki</label>
                    </fieldset>

                    <fieldset class="radio-group">
                        <legend>Jenis Identitas*</legend>
                        <label><input type="radio" name="identitas" value="KTP" required> KTP</label>
                        <label><input type="radio" name="identitas" value="SIM" required> SIM</label>
                        <label><input type="radio" name="identitas" value="Paspor" required> Paspor</label>
                    </fieldset>
                </div>

                <label for="bidang">Bidang Tujuan:*</label>
                <select id="bidang" name="bidang" required>
                    <option value="" disabled selected>Bidang yang Dituju</option>
                    @foreach ($bidang as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                </select>

                <label for="rekomendasi">Rekomendasi Cabdin:</label>
                <select id="rekomendasi" name="rekomendasi">
                    <option value="" disabled selected>Rekomendasi Cabdin</option>
                    @foreach ($rekomendasi as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                </select>

                <label>Foto Identitas:*</label>
                <div class="foto-container">
                    <video id="video" width="100%" autoplay style="display: none; max-width: 320px;"></video>
                    <canvas id="canvas" style="display: none; max-width: 320px;"></canvas>
                    <img src="/images/camera.png" alt="Camera Icon" id="camera-icon" style="max-width: 80px;">
                    <p id="camera-instruction">Arahkan Kartu Identitas Anda Ke Kamera, Lalu Klik Tombol Ini!</p>

                    <div class="camera-button-group">
                        <button type="button" id="capture" class="capture-btn">Aktifkan Kamera</button>
                        <button type="button" id="retake" class="capture-btn" style="display: none;">Ulangi
                            Foto</button>
                    </div>
                </div>

                <input type="hidden" name="foto" id="foto">
                <small class="note-text">*Wajib diisi</small>

            </div>
        </form>
    </div>

    <!-- JavaScript Kamera -->
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const captureButton = document.getElementById('capture');
            const retakeButton = document.getElementById('retake');
            const fotoInput = document.getElementById('foto');
            const cameraIcon = document.getElementById('camera-icon');
            const cameraInstruction = document.getElementById('camera-instruction');

            let stream;
            let isCameraActive = false;

            // Fungsi untuk menyalakan kamera
            async function startCamera() {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                    video.srcObject = stream;
                    video.style.display = 'block';
                    canvas.style.display = 'none';
                    cameraIcon.style.display = 'none';
                    cameraInstruction.style.display = 'none';
                    captureButton.innerText = 'Ambil Gambar';
                    isCameraActive = true;
                } catch (err) {
                    alert('Gagal mengakses kamera. Pastikan Anda mengizinkan akses kamera di browser.');
                }
            }

            // Tombol capture / aktifkan kamera
            captureButton.addEventListener('click', async () => {
                if (!isCameraActive) {
                    const confirmCamera = confirm("Apakah Anda ingin mengaktifkan kamera?\nKlik 'OK' lalu izinkan akses kamera di notifikasi browser.");
                    if (confirmCamera) await startCamera();
                } else {
                    // Ambil gambar dari video
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

                    // Stop kamera
                    stream.getTracks().forEach(track => track.stop());

                    // Simpan hasil ke input hidden
                    const imageData = canvas.toDataURL('image/png');
                    fotoInput.value = imageData;

                    // Tampilkan hasil dan atur tombol
                    canvas.style.display = 'block';
                    video.style.display = 'none';
                    captureButton.style.display = 'none';
                    retakeButton.style.display = 'inline-block';
                    isCameraActive = false;
                }
            });

            // Tombol untuk ulangi foto
            retakeButton.addEventListener('click', async () => {
                fotoInput.value = '';
                canvas.style.display = 'none';
                captureButton.style.display = 'inline-block';
                retakeButton.style.display = 'none';
                await startCamera();
            });
        });
    </script>


    </div>
    </form>
    </div>
    <footer>
        <div id="footer" class="footer-container">
            <div class="footer-logo">
                <img src="/images/logo footer.png" alt="Logo Dinas Pendidikan Jawa Timur">
            </div>

            <div class="footer-menu">
                <h4 style="text-decoration: underline;">Our Menu</h4>
                <ul>
                    <li><a href="#">Home</a>
                    <li><a href="#form-section">Form</a>
                    <li><a href="{{ route('contact') }}">Kontak</a>
                    <li><a href="{{ route('survey.welcome') }}">Survey</a>
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


</body>

</html>