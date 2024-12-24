<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ContactController extends Controller
{
    /**
     * แสดงรายละเอียดผู้ติดต่อ
     */
    public function showContactDetails($id)
    {
        $contact = Contact::findOrFail($id);
    
        // สร้างข้อมูล VCF ในรูปแบบ vCard
        $qrContent = "BEGIN:VCARD\n";
        $qrContent .= "VERSION:3.0\n";
        $qrContent .= "FN:{$contact->name}\n"; // ชื่อเต็ม
        $qrContent .= "TEL;TYPE=CELL,VOICE:{$contact->phone}\n"; // เบอร์โทรศัพท์มือถือ
        $qrContent .= "EMAIL:{$contact->email}\n"; // อีเมล

        if (!empty($contact->office_phone)) {
            $officePhone = trim($contact->office_phone);
            $qrContent .= "TEL:{$officePhone}\n"; // เบอร์โทรสำนักงาน
        }
        
        if (!empty($contact->address)) {
            $address = str_replace("\n", " ", trim($contact->address));
            $qrContent .= "ADR:;;{$address}\n"; // ที่อยู่
        }
        
    
        // เพิ่มข้อมูลโซเชียลใน vCard หากมีค่าในฐานข้อมูล
        $socialLinks = [
            'line' => $contact->social['line'] ?? null,
            'facebook' => $contact->social['facebook'] ?? null,
            'youtube' => $contact->social['youtube'] ?? null,
            'instagram' => $contact->social['instagram'] ?? null,
            'twitter' => $contact->social['twitter'] ?? null,
            'linkedin' => $contact->social['linkedin'] ?? null,
        ];
    
        foreach ($socialLinks as $platform => $url) {
            if (!empty($url)) {
                $qrContent .= "X-SOCIALPROFILE;TYPE={$platform}:{$url}\n";
            }
        }
    
        $qrContent .= "END:VCARD"; // จบข้อมูล vCard
    
        // ตรวจสอบความยาวข้อมูลใน QR Code และลดขนาดบางส่วนหากยาวเกินไป
        if (strlen($qrContent) > 1500) {
            $qrContent = "BEGIN:VCARD\nVERSION:3.0\n";
            $qrContent .= "FN:{$contact->name}\n";
            $qrContent .= "TEL;TYPE=CELL:{$contact->phone}\n";
            $qrContent .= "EMAIL:{$contact->email}\n";
            $qrContent .= "END:VCARD";
        }
    
        // สร้าง QR Code โดยใช้การเข้ารหัสเป็น UTF-8
        $qrCode = QrCode::size(150) // ขนาด QR Code
            ->encoding('UTF-8') // ใช้ UTF-8 เพื่อรองรับตัวอักษรที่หลากหลาย
            ->errorCorrection('L') // ใช้การแก้ไขข้อผิดพลาดระดับต่ำ (ลดความซับซ้อน)
            ->generate($qrContent);
    
        // ส่งข้อมูลไปยัง View
        return view('contact_detail', compact('contact', 'qrCode'));
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
        "VERSION:4.0",
        "FN:" . ($contact->name ?? 'N/A'),
        "ORG:" . ($contact->organization ?? 'N/A'),
        "TITLE:" . ($contact->position ?? ''),
        "EMAIL:" . ($contact->email ?? ''),
        "TEL;TYPE=CELL:" . ($contact->phone ?? 'N/A'),
        "TEL;TYPE=WORK:" . ($contact->office_phone ?? 'N/A'),
        "ADR;TYPE=WORK:;;" . ($contact->address ?? 'N/A') . ";;;;",
    ];

    // จัดการรูปภาพ
    if ($contact->profile_image && Storage::disk('public')->exists($contact->profile_image)) {
        $imagePath = Storage::disk('public')->path($contact->profile_image);

        // ตรวจสอบไฟล์และ MIME type
        if (file_exists($imagePath) && is_readable($imagePath)) {
            $mimeType = mime_content_type($imagePath);

            if (strpos($mimeType, 'image/') === 0) {
                $imageContent = file_get_contents($imagePath);
                $base64Image = base64_encode($imageContent);
                $photoHeader = "PHOTO;ENCODING=b;TYPE=" . strtoupper(explode('/', $mimeType)[1]) . ":";
                $photoContent = wordwrap($base64Image, 75, "\r\n ", true); // ตัด Base64 ให้ถูกต้อง
                $vcf[] = $photoHeader . $photoContent;
            }
        }
    }

    $vcf[] = "END:VCARD";

    return implode("\r\n", $vcf);
}









// แสดงหน้ารายการเจ้าหน้าที่พร้อมค้นหา/กรอง
public function showContacts(Request $request)
{
    $query = Contact::query();

    // ฟิลเตอร์การค้นหาจากคีย์เวิร์ด (ชื่อ, อีเมล)
    if ($request->filled('keyword')) {
        $query->where(function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%')
              ->orWhere('phone', 'like', '%' . $request->keyword . '%'); // หากต้องการค้นหาเบอร์โทร
        });
    }

    // ดึงข้อมูลพร้อม paginate และจัดเรียงตามชื่อ
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
        'title' => 'nullable|string|max:255',
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
            'title' => 'nullable|string|max:255',
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
