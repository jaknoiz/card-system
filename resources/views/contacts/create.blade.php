@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($contact) ? 'แก้ไขข้อมูลเจ้าหน้าที่' : 'เพิ่มข้อมูลเจ้าหน้าที่' }}</h2>

    <form action="{{ isset($contact) ? route('contacts.update', $contact->id) : route('contacts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($contact))
            @method('PUT')
        @endif

        <!-- ชื่อ-นามสกุล -->
        <div class="form-group">
            <label for="name">ชื่อ-นามสกุล</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $contact->name ?? '') }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        
        <!-- ตำแหน่ง -->
        <div class="form-group">
            <label for="position">ตำแหน่ง</label>
            <input type="text" name="position" class="form-control" value="{{ old('position', $contact->position ?? '') }}">
            @error('position')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- อีเมล -->
        <div class="form-group">
            <label for="email">อีเมล</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email ?? '') }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- เบอร์โทรศัพท์ -->
        <div class="form-group">
            <label for="phone">เบอร์โทรศัพท์</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $contact->phone ?? '') }}">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- เบอร์โทรศัพท์สำนักงาน -->
        <div class="form-group">
            <label for="office_phone">เบอร์โทรศัพท์สำนักงาน</label>
            <input type="text" name="office_phone" class="form-control" value="{{ old('office_phone', $contact->office_phone ?? '') }}">
            @error('office_phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ที่อยู่ -->
        <div class="form-group">
            <label for="address">ที่อยู่</label>
            <textarea name="address" class="form-control" rows="3">{{ old('address', $contact->address ?? '') }}</textarea>
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- องค์กร -->
        <div class="form-group">
            <label for="organization">องค์กร</label>
            <input type="text" name="organization" class="form-control" value="{{ old('organization', $contact->organization ?? '') }}">
            @error('organization')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- รูปโปรไฟล์ -->
        <div class="form-group">
            <label for="profile_image">รูปโปรไฟล์</label>
            <input type="file" name="profile_image" class="form-control-file">
            @if(isset($contact) && $contact->profile_image)
                <img src="{{ asset('storage/' . $contact->profile_image) }}" alt="Profile" class="img-thumbnail mt-2" width="150">
            @endif
            @error('profile_image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ข้อมูลโซเชียล -->
        <div class="form-group">
            <label for="social[line]">Line</label>
            <input type="url" name="social[line]" class="form-control" value="{{ old('social.line', $contact->social['line'] ?? '') }}">
            @error('social.line')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="social[facebook]">Facebook</label>
            <input type="url" name="social[facebook]" class="form-control" value="{{ old('social.facebook', $contact->social['facebook'] ?? '') }}">
            @error('social.facebook')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="social[youtube]">YouTube</label>
            <input type="url" name="social[youtube]" class="form-control" value="{{ old('social.youtube', $contact->social['youtube'] ?? '') }}">
            @error('social.youtube')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="social[instagram]">Instagram</label>
            <input type="url" name="social[instagram]" class="form-control" value="{{ old('social.instagram', $contact->social['instagram'] ?? '') }}">
            @error('social.instagram')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="social[twitter]">Twitter</label>
            <input type="url" name="social[twitter]" class="form-control" value="{{ old('social.twitter', $contact->social['twitter'] ?? '') }}">
            @error('social.twitter')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="social[linkedin]">LinkedIn</label>
            <input type="url" name="social[linkedin]" class="form-control" value="{{ old('social.linkedin', $contact->social['linkedin'] ?? '') }}">
            @error('social.linkedin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ปุ่มส่งฟอร์ม -->
        <button type="submit" class="btn btn-primary">
            {{ isset($contact) ? 'บันทึกการเปลี่ยนแปลง' : 'เพิ่มข้อมูล' }}
        </button>
    </form>
</div>
@endsection
