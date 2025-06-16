<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dinas Pendidikan Provinsi Jawa Timur</title>

    <!-- Tailwind & Font Awesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="/images/logo_tab.png">

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .nav-item:hover {
            background-color: #00218D;
            color: white;
        }
        .nav-item:hover i {
            color: white;
        }
        .nav-item.active {
            background-color: #00218D;
            color: white;
        }
        .nav-item.active i {
            color: white;
        }
        .btn-hover:hover {
            background-color: #00218D;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header-shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .footer-shadow {
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            border-bottom: 2px solid #00218D;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        .responsive-image {
            max-width: 100%;
            height: auto;
        }
    </style>

    <!-- Tambahan style dari halaman -->
    @yield('styles')
</head>

<body class="bg-gray-100">
<!-- Header -->
<header class="bg-blue-800 text-white p-4 flex justify-between items-center header-shadow">
    <div class="flex items-center">
        <a href="{{ route('admin.dashboardhome') }}" class="flex items-center">
            <img alt="Logo" class="h-15 w-10 mr-2" src="/images/logo_dashboard.png"/>
            <h1 class="text-2xl font-bold hover">Admin Buku Tamu</h1>
        </a>
    </div>

</header>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-1/4 bg-white p-6 shadow-lg">
            <nav>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-2 nav-item p-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="flex items-center space-x-2 nav-item p-2 rounded-lg {{ request()->routeIs('admin.dashboardhome') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <a href="{{ route('admin.dashboardhome') }}">Dashboard</a>
                    </li>
                    <li class="flex items-center space-x-2 nav-item p-2 rounded-lg {{ request()->routeIs('bukutamu.index') ? 'active' : '' }}">
                        <i class="fas fa-book"></i>
                        <a href="{{ route('bukutamu.index') }}">Buku Tamu</a>
                    </li>
                    <li class="flex items-center space-x-2 nav-item p-2 rounded-lg {{ request()->routeIs('admin.question.index') ? 'active' : '' }}">
                        <i class="fas fa-poll"></i>
                        <a href="{{ route('admin.question.index') }}">Survei</a>
                    </li>
                    <li class="flex items-center space-x-2 nav-item p-2 rounded-lg {{ request()->routeIs('admin.dataadmin.index') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <a href="{{ route('admin.dataadmin.index') }}">Data Admin</a>
                    </li>

                    <!-- Account Settings -->
                    <div class="mt-8">
                        <h2 class="text-gray-600 font-semibold section-title">Account Settings</h2>
                        <ul class="space-y-4 mt-4">
                            <li class="flex items-center space-x-2 nav-item p-2 rounded-lg">
                                <i class="fas fa-user-circle"></i>
                                <a href="{{ route('admin.profile') }}">Profile</a>
                            </li>
                            <li class="flex items-center space-x-2 nav-item p-2 rounded-lg">
                                <button onclick="confirmLogout()" class="flex items-center w-full text-left">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div class="mt-8 flex space-x-4">
                        <a href="https://www.facebook.com/Dindik.Jatim" class="text-gray-600 hover:text-blue-800"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/dindik_jatim" class="text-gray-600 hover:text-blue-800"><i class="fab fa-instagram"></i></a>
                        <a href="https://x.com/Dindik_Jatim" class="text-gray-600 hover:text-blue-800"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.youtube.com/c/DinasPendidikanProvinsiJawaTimur" class="text-gray-600 hover:text-blue-800"><i class="fab fa-youtube"></i></a>
                    </div>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="w-3/4 p-6">
            @yield('content')

        </main>
    </div>
    <!-- Toast Notification -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
  @if (session('success'))
    <div class="toast align-items-center text-white bg-success border-0" role="alert" id="toast-success" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif
  @if (session('error'))
    <div class="toast align-items-center text-white bg-danger border-0" role="alert" id="toast-error" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          {{ session('error') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  @endif
</div>


<!-- Footer -->
<footer class="bg-white p-6 mt-8 footer-shadow">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img alt="Logo" class="h-15 w-10 mr-2" src="/images/logo_dashboard.png"/>
                <div>
                    <h2 class="text-blue-800 font-bold">DINAS PENDIDIKAN PROVINSI JAWA TIMUR</h2>
                    <p class="text-gray-600">© 2025 Dinas Pendidikan Provinsi Jawa Timur</p>
                </div>
            </div>
            <div class="flex space-x-16">
                <div>
                    <h3 class="text-gray-600 font-semibold section-title">Contact Us</h3>
            <ul class="space-y-2 mt-2">
                <li class="text-gray-600">Jl. Genteng Kali No.33, Surabaya, Jawa Timur 60275</li>
                <li class="text-gray-600">dindik@jatimprov.go.id</li>
                <li class="text-gray-600">0811-310-8881</li>
                <li class="text-gray-600">lapor.go.id</li>
            </ul>
                </div>
                <div>
                    <h3 class="text-gray-600 font-semibold section-title">Social Media</h3>
            <ul class="space-y-2 mt-2">
                <li>
                    <a class="text-gray-600 hover:text-blue-800" href="https://www.facebook.com/Dindik.Jatim">
                        <i class="fab fa-facebook-f mr-2"></i> @Dindik.Jatim
                    </a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-blue-800" href="https://www.instagram.com/dindik_jatim">
                        <i class="fab fa-instagram mr-2"></i> @dindik_jatim
                    </a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-blue-800" href="https://x.com/Dindik_Jatim">
                        <i class="fab fa-twitter mr-2"></i> Dindik_Jatim
                    </a>
                </li>
                <li>
                    <a class="text-gray-600 hover:text-blue-800" href="https://www.youtube.com/c/DinasPendidikanProvinsiJawaTimur">
                        <i class="fab fa-youtube mr-2"></i> DinasPendidikanProvinsiJawaTimur
                    </a>
                </li>
            </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


    <!-- Tambahan script dari halaman -->
    @yield('scripts')
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmLogout() {
    Swal.fire({
        icon: 'warning',
        title: 'Apakah Anda yakin?',
        text: 'Anda akan keluar dari akun ini.',
        showCancelButton: true,
        confirmButtonText: 'Logout',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}

    window.addEventListener('DOMContentLoaded', () => {
    const toastSuccess = document.getElementById('toast-success');
    if (toastSuccess) {
        const bsToast = new bootstrap.Toast(toastSuccess, { delay: 1000 });
        bsToast.show();
    }

    const toastError = document.getElementById('toast-error');
    if (toastError) {
        const bsToast = new bootstrap.Toast(toastError, { delay: 1000 });
        bsToast.show();
    }
});
</script>

</body>
</html>
