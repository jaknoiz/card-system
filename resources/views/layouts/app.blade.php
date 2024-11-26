<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ระบบจัดการผู้ติดต่อ')</title>
    <!-- เพิ่ม Bootstrap หรือ CSS Framework (ถ้าจำเป็น) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- สำหรับไฟล์ CSS ของคุณ -->
</head>
<body>
    <!-- ส่วน Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">ระบบจัดการผู้ติดต่อ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacts.index') }}">รายชื่อผู้ติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacts.create') }}">เพิ่มผู้ติดต่อ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ส่วน Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- ส่วน Footer -->
    <footer class="text-center mt-4 py-4 bg-light">
        <p>&copy; {{ date('Y') }} ระบบจัดการผู้ติดต่อ. สงวนลิขสิทธิ์.</p>
    </footer>

    <!-- เพิ่ม JavaScript Framework (ถ้าจำเป็น) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
