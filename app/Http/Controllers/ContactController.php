<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * แสดงรายละเอียดผู้ติดต่อ
     */
    public function showContactDetails($id)
    {
        // ดึงข้อมูลผู้ติดต่อโดยใช้ ID
        $contact = Contact::findOrFail($id);

        // ส่งข้อมูลไปยัง View
        return view('contact_detail', compact('contact'));
    }

    /**
     * ดาวน์โหลดไฟล์ VCF
     */
    public function downloadVCF($id)
{
    // ดึงข้อมูลผู้ติดต่อจากฐานข้อมูล
    $contact = Contact::findOrFail($id);

    // สร้างเนื้อหา VCF
    $vcfContent = $this->generateVCF($contact);

    // สร้างชื่อไฟล์โดยใช้ชื่อผู้ติดต่อ
    $fileName = str_replace(' ', '_', $contact->name) . '.vcf';

    return response($vcfContent)
        ->header('Content-Type', 'text/vcard')
        ->header('Content-Disposition', "attachment; filename=\"{$fileName}\"");
}

private function generateVCF(Contact $contact): string
{
    $vcf = [
        "BEGIN:VCARD",
        "VERSION:3.0",
        "FN:" . ($contact->name ?? 'N/A'),
        "ORG:" . ($contact->organization ?? 'N/A'),
        "TITLE:" . ($contact->position ?? ''),  // เพิ่มตำแหน่ง (position) ที่นี่
        "ROLE:" . ($contact->position ?? ''),  // หากต้องการแสดงตำแหน่งอีกครั้งในฟิลด์ ROLE
        "EMAIL:" . ($contact->email ?? ''),
        "TEL;TYPE=CELL:" . ($contact->phone ?? ''),
        "TEL;TYPE=WORK:" . ($contact->office_phone ?? ''),
        "ADR;TYPE=WORK:;;" . ($contact->address ?? '') . ";;;;" . ($contact->country ?? ''),
    ];

    // ตรวจสอบและเพิ่มรูปภาพโปรไฟล์ใน VCF
    if ($contact->profile_image && Storage::exists($contact->profile_image)) {
        // ใช้ Storage::url เพื่อดึง URL ที่ถูกต้อง
        $imagePath = Storage::path($contact->profile_image);
        
        // อ่านเนื้อหาภาพจากไฟล์และแปลงเป็น Base64
        $imageContent = file_get_contents($imagePath);
        $base64Image = base64_encode($imageContent);
        $mimeType = 'image/jpeg'; // หรือ mime type ที่เหมาะสมสำหรับไฟล์ของคุณ

        // เพิ่มข้อมูลรูปภาพใน VCF
        $vcf[] = "PHOTO;ENCODING=b;TYPE={$mimeType}:{$base64Image}";
    }

    // ตรวจสอบว่า $contact->social เป็น array หรือไม่
    if (!empty($contact->social) && is_array($contact->social)) {
        foreach ($contact->social as $type => $url) {
            $vcf[] = "X-SOCIALPROFILE;TYPE={$type}:{$url}";
        }
    }

    $vcf[] = "END:VCARD";

    return implode("\n", $vcf);
}




    // แสดงหน้ารายการเจ้าหน้าที่พร้อมค้นหา/กรอง
    public function showContacts(Request $request)
    {
        $query = Contact::query();

        // ฟิลเตอร์การค้นหา
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%');
        }

        // ดึงข้อมูลพร้อม paginate
        $contacts = $query->orderBy('name')->paginate(10);

        return view('contacts.index', compact('contacts'));
    }

    // แสดงหน้าสร้างเจ้าหน้าที่
    public function create()
    {
        return view('contacts.create');
    }

    // บันทึกข้อมูลเจ้าหน้าที่ใหม่
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'nullable|string|max:255',
        'email' => 'required|email|unique:contacts,email',
        'phone' => 'nullable|string|max:20',
        'office_phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'organization' => 'nullable|string|max:255',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'social' => 'nullable|array',
        'social.*' => 'nullable|url',
    ]);

    // จัดการข้อมูลโปรไฟล์ภาพ
    if ($request->hasFile('profile_image')) {
        $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        $data['profile_image'] = $imagePath;
    }

    // บันทึกข้อมูลเจ้าหน้าที่
    Contact::create($data);

    return redirect()->route('contacts.index')->with('success', 'เพิ่มข้อมูลเจ้าหน้าที่สำเร็จ');
}


    // แสดงหน้าฟอร์มแก้ไขข้อมูล
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    // อัปเดตข้อมูลเจ้าหน้าที่
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'phone' => 'nullable|string|max:20',
            'office_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'organization' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'social' => 'nullable|array',
            'social.*' => 'nullable|url',
        ]);
    
        // จัดการข้อมูลโปรไฟล์ภาพ
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $imagePath;
        }
    
        // อัปเดตข้อมูลเจ้าหน้าที่
        $contact->update($data);
    
        return redirect()->route('contacts.index')->with('success', 'อัปเดตข้อมูลเจ้าหน้าที่สำเร็จ');
    }


    // ลบข้อมูลเจ้าหน้าที่
    public function destroy(Contact $contact)
    {
        if ($contact->profile_image) {
            Storage::disk('public')->delete($contact->profile_image);
        }

        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'ลบข้อมูลเจ้าหน้าที่สำเร็จ!');
    }
}
