<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Business Card</title> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500;600;700&display=swap" rel="stylesheet">
     <!-- เพิ่ม Favicon -->
     <link rel="icon" type="image/png" href="{{ asset('image/tsu.png') }}">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Prompt', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #0078D4, #00bcd4);
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 750px; /* ปรับความกว้างของการ์ด */
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            padding: 20px;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between; /* จัดให้อยู่ซ้าย-ขวา */
            margin-bottom: 20px;
        }

        .header img {
            width: 300px; /* ขยายขนาดโลโก้ */
        }

        .header .header-text {
            text-align: right; /* จัดข้อความให้อยู่ขวา */
        }

        .header .header-text h1 {
            font-size: 30px;
            color: #0078D4;
            font-weight: 600;
        }

        .header .header-text h2 {
            font-size: 20px;
            color: #ff8c00; /* สีส้ม */
            font-weight: 600;
        }

        .profile-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-info img {
            width: 250px;
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-info img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

        .profile-info h2 {
            font-size: 30px;
            margin: 10px 0;
            color: #333;
            font-weight: 600;
        }

        .profile-info p {
            font-size: 18px;
            color: #555;
            margin: 5px 0;
            font-weight: 500;
        }

        .contact-info {
            margin: 30px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .contact-info div {
            display: flex;
            align-items: center;
            font-size: 16px;
            color: #666;
            gap: 10px;
            background: #f5f5f5;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .contact-info div:hover {
            transform: scale(1.05);
        }

        .contact-info div img {
            width: 24px;
            height: 24px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
        }

        .social-icons a img {
            width: 40px;
            height: 40px;
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .social-icons a img:hover {
            transform: scale(1.2);
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        .qr-code img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .save-button {
            text-align: center;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #0078D4, #0056b3);
            color: #fff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="card">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('image/tsu-logo.png') }}" alt="University Logo">
            <div class="header-text">
                <h1>นามบัตรดิจิทัล</h1>
                <h2>DIGITAL BUSINESS CARD</h2>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="profile-info">
            <img src="{{ asset('storage/' . $contact->profile_image) }}" alt="Profile Image">
            <h2>{{ $contact['name'] }}</h2>
            <p>{{ $contact['title'] }}</p>
            <p>{{ $contact['position'] }}</p>
        </div>

        <!-- Contact Information -->
        <div class="contact-info">
            @if(!empty($contact['email']))
                <div>
                    <img src="{{ asset('image/email-icon.png') }}" alt="Email Icon"> {{ $contact['email'] }}
                </div>
            @endif
            @if(!empty($contact['phone']))
                <div>
                    <img src="{{ asset('image/phone-icon.png') }}" alt="Phone Icon"> {{ $contact['phone'] }}
                </div>
            @endif
            @if(!empty($contact['office_phone']))
                    <div>
                        <img src="{{ asset('image/old-phone.png') }}" alt="Office Phone Icon"> {{ $contact['office_phone'] }}
                    </div>
                @endif
            @if(!empty($contact['address']))
                <div>
                    <img src="{{ asset('image/address-icon.png') }}" alt="Address Icon"> {{ $contact['address'] }}
                </div>
            @endif
        </div>

         <!-- Social Icons -->
         <div class="social-icons">
                @if(isset($contact['social']['line']))
                    <a href="{{ $contact['social']['line'] }}" target="_blank">
                        <img src="{{ asset('image/line-icon.png') }}" alt="Line">
                    </a>
                @endif

                @if(isset($contact['social']['facebook']))
                    <a href="{{ $contact['social']['facebook'] }}" target="_blank">
                        <img src="{{ asset('image/facebook-icon.png') }}" alt="Facebook">
                    </a>
                @endif

                @if(isset($contact['social']['youtube']))
                    <a href="{{ $contact['social']['youtube'] }}" target="_blank">
                        <img src="{{ asset('image/youtube-icon.png') }}" alt="YouTube">
                    </a>
                @endif

                @if(isset($contact['social']['instagram']))
                    <a href="{{ $contact['social']['instagram'] }}" target="_blank">
                        <img src="{{ asset('image/instagram-icon.png') }}" alt="Instagram">
                    </a>
                @endif

                @if(isset($contact['social']['twitter']))
                    <a href="{{ $contact['social']['twitter'] }}" target="_blank">
                        <img src="{{ asset('image/x-icon.png') }}" alt="Twitter">
                    </a>
                @endif

                @if(isset($contact['social']['linkedin']))
                    <a href="{{ $contact['social']['linkedin'] }}" target="_blank">
                        <img src="{{ asset('image/linkedin-icon.png') }}" alt="LinkedIn">
                    </a>
                @endif
            </div>

        <!-- QR Code -->
        <div class="qr-code">
            {!! $qrCode !!}
        </div>

        <!-- Save Button -->
        <div class="save-button">
            <a href="{{ route('contact.download', $contact['id']) }}" class="btn">บันทึกผู้ติดต่อ</a>
        </div>
    </div>
</body>
</html>
