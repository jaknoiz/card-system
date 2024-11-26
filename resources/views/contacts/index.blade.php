@extends('layouts.app')

@section('content')
<div class="container">
    <h2>รายชื่อเจ้าหน้าที่</h2>

    <form action="{{ route('contacts.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="ค้นหา..." value="{{ request('keyword') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">ค้นหา</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>อีเมล</th>
                <th>เบอร์โทร</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>
                        <!-- ปุ่มดูรายละเอียด -->
                        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm">ดูรายละเอียด</a>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ?')">ลบ</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">ไม่พบข้อมูล</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- แสดง Pagination -->
    {{ $contacts->appends(request()->query())->links() }}
</div>
@endsection
