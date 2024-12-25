@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">รายชื่อเจ้าหน้าที่</h2>
        <a href="{{ route('contacts.create') }}" class="btn btn-success"> + เพิ่มเจ้าหน้าที่ใหม่</a>
    </div>

    <!-- ฟอร์มค้นหา -->
    <form action="{{ route('contacts.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input 
                type="text" 
                name="keyword" 
                class="form-control" 
                placeholder="ค้นหาชื่อ, อีเมล หรือเบอร์โทร..." 
                value="{{ request('keyword') }}">
            <button class="btn btn-primary" type="submit">ค้นหา</button>
        </div>
    </form>

    <!-- ตารางแสดงข้อมูล -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ชื่อ</th>
                    <th>อีเมล</th>
                    <th>เบอร์โทร</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td class="text-center">
                            <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> ดูนามบัตรดิจิทัล
                            </a>
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> แก้ไข
                            </a>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="btn btn-danger btn-sm" 
                                    onclick="return confirm('ยืนยันการลบ?')">
                                    <i class="fas fa-trash"></i> ลบ
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">ไม่พบข้อมูล</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- แสดง Pagination -->
    <div class="mt-4">
        {{ $contacts->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            title: 'สำเร็จ!',
            text: @json(session('success')),
            icon: 'success',
            confirmButtonText: 'ตกลง'
        });
    </script>
@endif
@endsection
