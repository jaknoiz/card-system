<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ระบบนามบัตรดิจิทัล')</title>
     <!-- เพิ่ม Favicon -->
     <link rel="icon" type="image/png" href="{{ asset('image/tsu.png') }}">
    <!-- เพิ่ม Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- เพิ่มฟอนต์ Prompt -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<style>
    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        font-family: 'Prompt', sans-serif; /* ใช้ฟอนต์ Prompt */
        background-color: #f5f9ff;
    }

    .container {
        flex: 1;
    }

    .navbar {
        background-color: #0056b3; /* พื้นหลังสีน้ำเงิน */
    }

    .navbar-brand {
        display: flex;
        align-items: center; /* จัดให้อยู่กึ่งกลางแนวตั้ง */
        color: #ffffff !important;
        font-weight: bold;
    }

    .navbar-brand img {
        height: 70px;
        margin-right: 10px;
        border-right: 2px solid #ffffff; /* เส้นขีดกั้นระหว่างโลโก้กับชื่อ */
        padding-right: 10px; /* เว้นระยะจากเส้นขีด */
    }

    .nav-link {
        color: #ffffff !important;
        font-weight: bold;
    }

    .nav-link:hover {
        color: #ffdd57 !important; /* สีเหลืองเมื่อ hover */
    }

    footer {
        background-color: #0056b3; /* สีน้ำเงินเข้ม */
        color: #ffffff;
        text-align: center;
        padding: 15px 0;
    }

    footer a {
        color: #ffdd57; /* สีเหลืองสำหรับลิงก์ใน footer */
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }
</style>
<body>
    <!-- ส่วน Header -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('image/tsu-logo.png') }}" alt="Logo">
                ระบบนามบัตรดิจิทัล
            </a>
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
    <footer>
        <p>&copy; {{ date('Y') }} <a href="{{ url('/') }}">ระบบนามบัตรดิจิทัล</a>. สงวนลิขสิทธิ์.</p>
    </footer>

    <!-- เพิ่ม JavaScript Framework -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
