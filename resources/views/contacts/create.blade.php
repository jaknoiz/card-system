@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-danger fw-bold">
            {{ isset($contact) ? 'แก้ไขข้อมูลเจ้าหน้าที่' : 'เพิ่มข้อมูลเจ้าหน้าที่' }}
        </h2>
    </div>

    <form action="{{ isset($contact) ? route('contacts.update', $contact->id) : route('contacts.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if(isset($contact))
            @method('PUT')
        @endif

        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold">ข้อมูลส่วนตัว</div>
            <div class="card-body">
                <div class="row">
                    <!-- ชื่อ-นามสกุล -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $contact->name ?? '') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- ตำแหน่ง -->
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">ตำแหน่ง</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $contact->title ?? '') }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- ตำแหน่งบริหาร -->
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">ตำแหน่งบริหาร</label>
                        <input type="text" name="position" class="form-control" value="{{ old('position', $contact->position ?? '') }}">
                        @error('position')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- องค์กร -->
                    <div class="col-md-6 mb-3">
                        <label for="organization" class="form-label">องค์กร</label>
                        <input type="text" name="organization" class="form-control" value="{{ old('organization', $contact->organization ?? '') }}">
                        @error('organization')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold">ข้อมูลการติดต่อ</div>
            <div class="card-body">
                <div class="row">
                    <!-- อีเมล -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">อีเมล</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email ?? '') }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- เบอร์โทรศัพท์ -->
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $contact->phone ?? '') }}">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- เบอร์โทรศัพท์สำนักงาน -->
                    <div class="col-md-6 mb-3">
                        <label for="office_phone" class="form-label">เบอร์โทรศัพท์สำนักงาน</label>
                        <input type="text" name="office_phone" class="form-control" value="{{ old('office_phone', $contact->office_phone ?? '') }}">
                        @error('office_phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- ที่อยู่ -->
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address', $contact->address ?? '') }}</textarea>
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold">โซเชียลมีเดีย</div>
            <div class="card-body">
                <div class="row">
                    <!-- Line -->
                    <div class="col-md-4 mb-3">
                        <label for="social[line]" class="form-label">Line</label>
                        <input type="url" name="social[line]" class="form-control" value="{{ old('social.line', $contact->social['line'] ?? '') }}">
                        @error('social.line')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Facebook -->
                    <div class="col-md-4 mb-3">
                        <label for="social[facebook]" class="form-label">Facebook</label>
                        <input type="url" name="social[facebook]" class="form-control" value="{{ old('social.facebook', $contact->social['facebook'] ?? '') }}">
                        @error('social.facebook')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Twitter -->
                    <div class="col-md-4 mb-3">
                        <label for="social[twitter]" class="form-label">Twitter</label>
                        <input type="url" name="social[twitter]" class="form-control" value="{{ old('social.twitter', $contact->social['twitter'] ?? '') }}">
                        @error('social.twitter')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <!-- YouTube -->
                    <div class="col-md-4 mb-3">
                        <label for="social[youtube]" class="form-label">YouTube</label>
                        <input type="url" name="social[youtube]" class="form-control" value="{{ old('social.youtube', $contact->social['youtube'] ?? '') }}">
                        @error('social.youtube')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Instagram -->
                    <div class="col-md-4 mb-3">
                        <label for="social[instagram]" class="form-label">Instagram</label>
                        <input type="url" name="social[instagram]" class="form-control" value="{{ old('social.instagram', $contact->social['instagram'] ?? '') }}">
                        @error('social.instagram')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- LinkedIn -->
                    <div class="col-md-4 mb-3">
                        <label for="social[linkedin]" class="form-label">LinkedIn</label>
                        <input type="url" name="social[linkedin]" class="form-control" value="{{ old('social.linkedin', $contact->social['linkedin'] ?? '') }}">
                        @error('social.linkedin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- รูปโปรไฟล์ -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white fw-bold">รูปโปรไฟล์</div>
            <div class="card-body text-center">
                <input type="file" name="profile_image" class="form-control mb-3" id="profile_image" onchange="previewImage(event)" required>
                <div id="image_preview">
                    @if(isset($contact) && $contact->profile_image)
                        <img src="{{ asset('storage/' . $contact->profile_image) }}" alt="Profile" class="img-thumbnail" width="150">
                    @endif
                </div>
                @error('profile_image')
                    <small class="text-danger d-block">{{ $message }}</small>
                @enderror
            </div>
        </div>


        <div class="d-flex justify-content-center gap-3 mb-4">
            <a href="{{ route('contacts.index') }}" class="btn btn-danger">
                ย้อนกลับ
            </a>
            <button type="submit" class="btn btn-primary">
                {{ isset($contact) ? 'บันทึกการเปลี่ยนแปลง' : 'เพิ่มข้อมูล' }}
            </button>
        </div>
    </form>
</div>

<script>
    // Function to preview the selected image
    function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var imgElement = '<img src="' + e.target.result + '" class="img-thumbnail" width="150">';
            document.getElementById('image_preview').innerHTML = imgElement;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
