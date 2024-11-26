<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'name' => 'สมศรี มากแสง',
            'title' => 'ผู้ช่วยศาสตราจารย์',
            'position' => 'รองอธิการบดีฝ่ายการศึกษาและดิจิทัล',
            'email' => 'somsi@tsu.ac.th',
            'phone' => '+66869851574',
            'office_phone' => '+66869851574',
            'address' => '140 ถ.กาญจวนิช ตำบล เขารูปช้าง อำเภอเมืองสงขลา สงขลา 90000',
            'organization' => 'Thaksin University',
            'profile_image' => 'image/profile1.jpg',
            'country' => 'Thailand',
            'social' => json_encode([
                'line' => 'https://line.me/ti/p/username',
                'facebook' => 'https://facebook.com/username',
                'youtube' => 'https://www.youtube.com/watch?v=Y5ykCBT9TCo',
                'instagram' => 'https://instagram.com/username',
                'twitter' => 'https://twitter.com/username',
                'linkedin' => 'https://linkedin.com/in/username',
            ]),
        ]);
    }
}
