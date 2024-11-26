<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อเจ้าหน้าที่</title>
</head>
<body>
    <h1>รายชื่อเจ้าหน้าที่</h1>
    <ul>
        @foreach ($contacts as $contact)
            <li>
                <a href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
