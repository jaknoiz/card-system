<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Business Card</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            background-color: #e8eff3; /* Light, cool background */
        }

        .card {
            width: 850px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px); /* Slight hover effect */
        }

        .left-section {
            width: 40%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-right: 2px solid #e0e0e0;
            background-color: #f1f8ff; /* Soft blue background */
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .left-section img {
            width: 160px;
            height: 220px;
            object-fit: cover;
            
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .left-section img:hover {
            transform: scale(1.05); /* Zoom effect on image hover */
        }

        .qr-code {
            margin-top: 20px;
        }

        .qr-code img {
            width: 160px;
            height: 160px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .qr-code img:hover {
            transform: scale(1.05); /* Slight zoom on QR code */
        }

        .right-section {
            width: 60%;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .university-logo {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .university-logo img {
            width: 200px;
            transition: transform 0.3s ease;
        }

        .university-logo img:hover {
            transform: scale(1.05); /* Hover effect on logo */
        }

        .university-title {
            text-align: right;
        }

        .university-title h2 {
            font-size: 24px;
            margin: 0;
            color: #0078D4;
            font-weight: 600;
        }

        .university-title p {
            font-size: 16px;
            margin: 0;
            color: #f28000;
            font-weight: 500;
        }

        .profile-info {
            margin-top: 20px;
            font-size: 18px;
        }

        .profile-info h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 5px;
        }

        .profile-info p {
            font-size: 18px;
            margin: 4px 0;
            color: #555;
        }

        .contact-info {
            margin-top: 20px;
        }

        .contact-info div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 16px;
            color: #666;
        }

        .contact-info div img {
            width: 22px;
            height: 22px;
            margin-right: 12px;
            
        }

        .contact-info div img:hover {
            filter: grayscale(0);
        }

        .social-icons {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
            margin-top: 15px;
        }

        .social-icons a img {
            width: 35px;
            height: 35px;
            transition: transform 0.3s ease;
        }

        .social-icons a img:hover {
            transform: scale(1.2);
        }

        .save-button {
            text-align: center;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-3px); /* Button hover effect */
        }

    </style>
</head>
<body>
    <div class="card">
        <!-- Left Section -->
        <div class="left-section">
            <img src="{{ asset('storage/' . $contact->profile_image) }}" alt="Profile Image">
            <div class="qr-code">
                {!! $qrCode !!}
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <!-- University Header -->
            <div class="university-logo">
                <img src="{{ asset('image/tsu-logo.png') }}" alt="University Logo">
                <div class="university-title">
                    <h2>นามบัตรดิจิทัล</h2>
                    <p>DIGITAL BUSINESS CARD</p>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="profile-info">
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
        </div>
    </div>

    <!-- Save Button Outside the Card -->
    <div class="save-button">
        <a href="{{ route('contact.download', $contact['id']) }}" class="btn">บันทึกผู้ติดต่อ</a>
    </div>
</body>
</html>
