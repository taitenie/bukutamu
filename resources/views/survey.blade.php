<!-- survey.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dindik Jatim</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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
            margin: 0;
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
            z-index: 1000;
            font-weight: bold;
            flex-wrap: wrap;
        }

        .navbar .nav-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            flex: 1;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .navbar .sign-in {
            background-color: #8E90F6;
            padding: 8px 15px;
            border-radius: 20px;
            white-space: nowrap;
        }

        a {
            color: black;
            text-decoration: none;
        }

        .footer-container a:hover {
            color: #0033A0;
        }

        .logo-container img {
            height: 40px;
            margin-right: 10px;
        }

        .survey-container {
            padding: 100px 20px 40px;
            max-width: 1000px;
            margin: auto;
        }

        .survey-question {
            font-size: 24px;
            margin-bottom: 30px;
            padding: 0 10px;
            text-align: center;
        }

        .survey-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .option {
            border: 2px solid #00218D;
            border-radius: 20px;
            padding: 12px 20px;
            width: 100%;
            max-width: 400px;
            text-align: left;
            background-color: white;
            font-size: 16px;
            transition: 0.3s;
            box-sizing: border-box;
            cursor: pointer;
        }

        .option input[type="radio"] {
            margin-right: 10px;
        }

        .option input[type="radio"]:checked {
            accent-color: #00218D;
        }

        .option:has(input:checked) {
            background-color: #8E90F6;
            color: white;
            font-weight: bold;
            border-color: #8E90F6;
        }

        .next-btn {
            margin-top: 30px;
            padding: 10px 40px;
            background-color: #00218D;
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .next-btn:hover {
            background-color: #001666;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Style untuk alert peringatan */
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px 20px;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
        }

        footer {
            background: white;
            padding: 20px;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-logo img {
            width: 100%;
            max-width: 250px;
            margin-bottom: 10px;
            padding-top: 35px;
        }

        .footer-menu,
        .footer-contact,
        .footer-social {
            flex: 1;
            min-width: 220px;
            max-width: 300px;
        }

        .footer-menu h4,
        .footer-contact h4,
        .footer-social h4 {
            color: #0033A0;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .footer-menu ul {
            list-style: none;
            padding: 0;
            font-size: 14px;
        }

        .footer-menu ul li {
            margin-bottom: 8px;
        }

        .footer-contact p,
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

        .footer-social p img {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            flex-shrink: 0;
            margin-bottom: 5px;
        }

        .footer-line {
            border: none;
            border-top: 2px solid orange;
            margin: 10px 0;
        }

        .footer-bottom {
            text-align: center;
            font-size: 14px;
            color: black;
        }
    </style>
</head>

<body>
    <!-- Halaman Survey -->
    <div class="survey-container fade-in-up">
        <h2 class="survey-question">{{ $question->question_text }}</h2>

        <!-- Alert peringatan -->
        <div id="alertMessage" class="alert">
            Silakan pilih salah satu jawaban sebelum melanjutkan!
        </div>

        <form class="survey-form" method="POST" action="{{ route('survey.answer') }}" id="surveyForm">
            @csrf
            <input type="hidden" name="step" value="{{ $step }}">

            @php
                $options = ['Sangat Tidak Setuju', 'Tidak Setuju', 'Netral', 'Setuju', 'Sangat Setuju'];
            @endphp

            @foreach ($options as $index => $val)
                <label class="option" for="option{{ $index }}">
                    <input type="radio" id="option{{ $index }}" name="jawaban" value="{{ $val }}" {{ $prevAnswer == $val ? 'checked' : '' }} style="display: none;">
                    {{ $val }}
                </label>
            @endforeach

            @php
                $totalQuestions = is_array($questions) || $questions instanceof Countable ? count($questions) : 1;
            @endphp

            <div class="button-group">
                @if ($step > 1)
                    <button type="button" onclick="submitForm('back')" class="next-btn">Back</button>
                @endif

                @if ($step < $totalQuestions)
                    <button type="button" onclick="submitForm('next')" class="next-btn">Next</button>
                @else
                    <button type="button" onclick="submitForm('submit')" class="next-btn">Submit</button>
                @endif
            </div>

            <!-- Hidden input untuk action -->
            <input type="hidden" name="action" id="actionInput" value="">
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="/images/logo footer.png" alt="Logo Dinas Pendidikan Jawa Timur">
            </div>

            <div class="footer-menu">
                <h4 style="text-decoration:underline">Our Menu</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('home') }}">Form</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                    <li><a href="{{ route('survey.welcome') }}">Survey</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4 style="text-decoration:underline">Contact Us</h4>
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
                    <a href="https://x.com/Dindik_Jatim" target="_blank" rel="noopener noreferrer">
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
        // Fungsi untuk memvalidasi dan submit form
        function submitForm(action) {
            const form = document.getElementById('surveyForm');
            const radios = form.querySelectorAll('input[name="jawaban"]');
            const alertMessage = document.getElementById('alertMessage');
            const actionInput = document.getElementById('actionInput');
            
            let isChecked = false;
            
            // Cek apakah ada radio button yang dipilih
            for (let radio of radios) {
                if (radio.checked) {
                    isChecked = true;
                    break;
                }
            }
            
            // Jika tombol Back, langsung submit tanpa validasi
            if (action === 'back') {
                actionInput.value = action;
                form.submit();
                return;
            }
            
            // Untuk tombol Next dan Submit, lakukan validasi
            if (!isChecked) {
                // Tampilkan alert peringatan
                alertMessage.style.display = 'block';
                
                // Scroll ke atas untuk memastikan alert terlihat
                alertMessage.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
                
                // Sembunyikan alert setelah 5 detik
                setTimeout(() => {
                    alertMessage.style.display = 'none';
                }, 5000);
                
                return false;
            }
            
            // Sembunyikan alert jika ada
            alertMessage.style.display = 'none';
            
            // Set action dan submit form
            actionInput.value = action;
            form.submit();
        }
        
        // Event listener untuk menyembunyikan alert ketika user memilih jawaban
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="jawaban"]');
            const alertMessage = document.getElementById('alertMessage');
            
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (alertMessage.style.display === 'block') {
                        alertMessage.style.display = 'none';
                    }
                });
            });
        });
        
        // Menangani klik pada label untuk memilih radio button
        document.querySelectorAll('.option').forEach(option => {
            option.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                    
                    // Trigger change event
                    radio.dispatchEvent(new Event('change'));
                }
            });
        });
    </script>
</body>

</html>