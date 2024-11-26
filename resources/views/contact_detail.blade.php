<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 360px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .card-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile {
            text-align: center;
            padding: 20px 10px;
        }

        .profile img {
            width: 100px;
            height: auto;
        }

        .profile h2 {
            font-size: 18px;
            margin: 10px 0 5px;
            color: #333;
        }

        .profile p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .info {
            padding: 10px 20px;
            font-size: 14px;
            color: #555;
        }

        .info div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .info div img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .info .address {
            margin-top: 10px;
            font-size: 13px;
            color: #777;
            line-height: 1.6;
        }

        .card-footer {
            text-align: center;
            margin: 20px 0;
        }

        .card-footer img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .card-footer .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .card-footer .btn:hover {
            background-color: #0056b3;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .social-icons a img {
            width: 32px;
            height: 32px;
            transition: transform 0.3s ease;
        }

        .social-icons a img:hover {
            transform: scale(1.2);
        }
        .divider {
            width: 100%;
            height: 10px;
            background-color: #178feb; /* สีของเส้นคั่น */
            margin: 0;
        }

    </style>
</head>
<body>
    <div class="card">
        <!-- Header -->
        <div class="card-header">
        <img src="{{ asset('storage/' . $contact->profile_image) }}" alt="Profile" class="img-thumbnail mt-2" width="150">
        </div>

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Profile -->
        <div class="profile">
            <img src="{{ asset('image/tsu-logo.png') }}" alt="University Logo">
            <h2>{{ $contact['name'] }}</h2>
            <p>{{ $contact['title'] }}</p>
            <p>{{ $contact['position'] }}</p>
        </div>

        <!-- Contact Information -->
        <div class="info">
            <div>
                <img src="{{ asset('image/email-icon.png') }}" alt="Email Icon"> {{ $contact['email'] }}
            </div>
            <div>
                <img src="{{ asset('image/phone-icon.png') }}" alt="Phone Icon"> {{ $contact['phone'] }}
            </div>
            <div>
                <img src="{{ asset('image/old-phone.png') }}" alt="Office Phone Icon"> {{ $contact['office_phone'] }}
            </div>
            <div class="address">
                <img src="{{ asset('image/address-icon.png') }}" alt="Address Icon"> 
                {{ $contact['address'] }}
            </div>
        </div>

       <!-- Footer -->
<div class="card-footer">
    
    
    <!-- Social Icons -->
    <div class="social-icons text-center">
    @if(isset($contact['social']['line']))
        <a href="{{ $contact['social']['line'] }}" target="_blank">
            <img src="{{ asset('image/line-icon.png') }}" alt="Line" class="social-icon">
        </a>
    @endif

    @if(isset($contact['social']['facebook']))
        <a href="{{ $contact['social']['facebook'] }}" target="_blank">
            <img src="{{ asset('image/facebook-icon.png') }}" alt="Facebook" class="social-icon">
        </a>
    @endif

    @if(isset($contact['social']['youtube']))
        <a href="{{ $contact['social']['youtube'] }}" target="_blank">
            <img src="{{ asset('image/youtube-icon.png') }}" alt="YouTube" class="social-icon">
        </a>
    @endif

    @if(isset($contact['social']['instagram']))
        <a href="{{ $contact['social']['instagram'] }}" target="_blank">
            <img src="{{ asset('image/instagram-icon.png') }}" alt="Instagram" class="social-icon">
        </a>
    @endif

    @if(isset($contact['social']['twitter']))
        <a href="{{ $contact['social']['twitter'] }}" target="_blank">
            <img src="{{ asset('image/x-icon.png') }}" alt="Twitter" class="social-icon">
        </a>
    @endif

    @if(isset($contact['social']['linkedin']))
        <a href="{{ $contact['social']['linkedin'] }}" target="_blank">
            <img src="{{ asset('image/linkedin-icon.png') }}" alt="LinkedIn" class="social-icon">
        </a>
    @endif
</div>

            <a href="{{ route('contact.download', $contact['id']) }}" class="btn">บันทึกผู้ติดต่อ</a>

        </div>
    </div>
</body>
</html>
