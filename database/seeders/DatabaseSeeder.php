<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Food;
use App\Models\PhysicalActivity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin SISD',
            'email'    => 'admin@sisd.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Ahli Gizi
        User::create([
            'name'      => 'Dr. Sari Nutrisi',
            'email'     => 'sari@sisd.id',
            'password'  => Hash::make('password'),
            'role'      => 'ahli_gizi',
            'is_online' => true,
        ]);

        User::create([
            'name'      => 'Dr. Budi Gizi',
            'email'     => 'budi@sisd.id',
            'password'  => Hash::make('password'),
            'role'      => 'ahli_gizi',
            'is_online' => false,
        ]);

        // Pengguna
        User::create([
            'name'           => 'Alexandra',
            'email'          => 'user@sisd.id',
            'password'       => Hash::make('password'),
            'role'           => 'pengguna',
            'umur'           => 25,
            'jenis_kelamin'  => 'P',
        ]);

        // Skor: a=1, b=2, c=3, d=4
        $pertanyaans = [

            [
                'fase'       => 1,
                'urutan'     => 1,
                'pertanyaan' => 'Seberapa sering Anda melakukan olahraga atau aktivitas fisik?',
                'opts'       => [
                    ['jawaban' => 'Setiap Hari',       'skor' => 4],
                    ['jawaban' => '3-5 kali/Minggu',   'skor' => 3],
                    ['jawaban' => '1-2 kali/Minggu',   'skor' => 2],
                    ['jawaban' => 'Tidak Pernah',       'skor' => 1],
                ],
            ],
            [
                'fase'       => 1,
                'urutan'     => 2,
                'pertanyaan' => 'Berapa lama waktu duduk atau rebahan Anda dalam sehari (di luar waktu tidur)?',
                'opts'       => [
                    ['jawaban' => '< 2 Jam', 'skor' => 4],
                    ['jawaban' => '2-4 Jam', 'skor' => 3],
                    ['jawaban' => '5-7 Jam', 'skor' => 2],
                    ['jawaban' => '> 7 Jam', 'skor' => 1],
                ],
            ],
            [
                'fase'       => 1,
                'urutan'     => 3,
                'pertanyaan' => 'Seberapa sering Anda tidur larut malam (di atas pukul 23.00 WIB)?',
                'opts'       => [
                    ['jawaban' => 'Tidak Pernah',       'skor' => 4],
                    ['jawaban' => 'Jarang',              'skor' => 3],
                    ['jawaban' => 'Sering',              'skor' => 2],
                    ['jawaban' => 'Hampir Setiap Hari',  'skor' => 1],
                ],
            ],
            [
                'fase'       => 1,
                'urutan'     => 4,
                'pertanyaan' => 'Seberapa sering Anda mengonsumsi makanan cepat saji atau gorengan?',
                'opts'       => [
                    ['jawaban' => 'Tidak Pernah',       'skor' => 4],
                    ['jawaban' => '1-2 kali/Minggu',    'skor' => 3],
                    ['jawaban' => '3-4 kali/Minggu',    'skor' => 2],
                    ['jawaban' => 'Hampir Setiap Hari', 'skor' => 1],
                ],
            ],
            [
                'fase'       => 1,
                'urutan'     => 5,
                'pertanyaan' => 'Seberapa sering Anda mengonsumsi buah dan sayur?',
                'opts'       => [
                    ['jawaban' => 'Setiap Hari',        'skor' => 4],
                    ['jawaban' => '3-5 kali/Minggu',    'skor' => 3],
                    ['jawaban' => '1-2 kali/Minggu',    'skor' => 2],
                    ['jawaban' => 'Tidak Pernah',        'skor' => 1],
                ],
            ],

            // ── FASE 2: Pola Makan & Istirahat
            [
                'fase'       => 2,
                'urutan'     => 6,
                'pertanyaan' => 'Berapa kali Anda makan dalam sehari?',
                'opts'       => [
                    ['jawaban' => '3 Kali Teratur',          'skor' => 4],
                    ['jawaban' => '2 Kali Sehari',            'skor' => 3],
                    ['jawaban' => 'Tidak Teratur',            'skor' => 2],
                    ['jawaban' => 'Sering Makan Berlebihan',  'skor' => 1],
                ],
            ],
            [
                'fase'       => 2,
                'urutan'     => 7,
                'pertanyaan' => 'Seberapa sering Anda mengonsumsi minuman manis?',
                'opts'       => [
                    ['jawaban' => 'Tidak Pernah',           'skor' => 4],
                    ['jawaban' => '1 kali/Hari',             'skor' => 3],
                    ['jawaban' => '2-3 kali/Hari',           'skor' => 2],
                    ['jawaban' => 'Lebih Dari 3 kali/Hari',  'skor' => 1],
                ],
            ],
            [
                'fase'       => 2,
                'urutan'     => 8,
                'pertanyaan' => 'Seberapa sering Anda tidur kurang dari 7 jam sehari?',
                'opts'       => [
                    ['jawaban' => 'Tidak Pernah',       'skor' => 4],
                    ['jawaban' => 'Jarang',              'skor' => 3],
                    ['jawaban' => 'Sering',              'skor' => 2],
                    ['jawaban' => 'Hampir Setiap Hari',  'skor' => 1],
                ],
            ],
            [
                'fase'       => 2,
                'urutan'     => 9,
                'pertanyaan' => 'Seberapa sering Anda menggunakan gadget sambil makan?',
                'opts'       => [
                    ['jawaban' => 'Tidak Pernah',       'skor' => 4],
                    ['jawaban' => 'Jarang',              'skor' => 3],
                    ['jawaban' => 'Sering',              'skor' => 2],
                    ['jawaban' => 'Hampir Setiap Hari',  'skor' => 1],
                ],
            ],
            [
                'fase'       => 2,
                'urutan'     => 10,
                'pertanyaan' => 'Seberapa sering Anda minum air putih minimal 8 gelas per hari?',
                'opts'       => [

                    ['jawaban' => 'Hampir Setiap Hari', 'skor' => 4],
                    ['jawaban' => 'Sering',              'skor' => 3],
                    ['jawaban' => 'Jarang',              'skor' => 2],
                    ['jawaban' => 'Tidak Pernah',        'skor' => 1],
                ],
            ],
        ];

        foreach ($pertanyaans as $p) {
            $q = Question::create([
                'pertanyaan' => $p['pertanyaan'],
                'fase'       => $p['fase'],
                'urutan'     => $p['urutan'],
            ]);

            foreach ($p['opts'] as $opt) {
                QuestionOption::create([
                    'question_id' => $q->id,
                    'jawaban'     => $opt['jawaban'],
                    'skor'        => $opt['skor'],
                ]);
            }
        }

        // ── Makanan
        $foods = [
            ['nama' => 'Nasi Putih',         'kalori' => 175, 'protein' => 4,  'karbohidrat' => 38, 'lemak' => 0.5],
            ['nama' => 'Ayam Bakar',          'kalori' => 220, 'protein' => 30, 'karbohidrat' => 0,  'lemak' => 10],
            ['nama' => 'Salad Buah Segar',    'kalori' => 150, 'protein' => 2,  'karbohidrat' => 25, 'lemak' => 5],
            ['nama' => 'Tempe Goreng',        'kalori' => 200, 'protein' => 14, 'karbohidrat' => 12, 'lemak' => 10],
            ['nama' => 'Sayur Bayam',         'kalori' => 40,  'protein' => 3,  'karbohidrat' => 5,  'lemak' => 0.5],
            ['nama' => 'Telur Rebus',         'kalori' => 77,  'protein' => 6,  'karbohidrat' => 1,  'lemak' => 5],
            ['nama' => 'Roti Gandum',         'kalori' => 120, 'protein' => 5,  'karbohidrat' => 22, 'lemak' => 2],
            ['nama' => 'Susu Full Cream',     'kalori' => 149, 'protein' => 8,  'karbohidrat' => 12, 'lemak' => 8],
            ['nama' => 'Pisang',              'kalori' => 89,  'protein' => 1,  'karbohidrat' => 23, 'lemak' => 0.3],
        ];

        foreach ($foods as $f) {
            Food::create($f);
        }

        // ── Aktivitas Fisik
        $activities = [
            [
                'nama' => 'Jalan Santai',
                'deskripsi' => 'Jalan kaki 30 menit dengan kecepatan sedang untuk menjaga kebugaran.',
                'status_kebiasaan' => 'Hidup Sehat',
                'durasi' => '30-45 Menit',
                'intensitas' => 'Sedang',
                'lokasi' => 'Luar Ruangan',
                'gambar' => 'jalan_santai.jpg',
            ],

            [
                'nama' => 'Lari Pagi',
                'deskripsi' => 'Lari selama 20-30 menit untuk membakar kalori dan meningkatkan kardio.',
                'status_kebiasaan' => 'Hidup Sehat',
                'durasi' => '20-30 Menit',
                'intensitas' => 'Tinggi',
                'lokasi' => 'Luar Ruangan',
                'gambar' => 'lari_pagi.jpg',
            ],

            [
                'nama' => 'Yoga',
                'deskripsi' => 'Latihan peregangan dan pernapasan untuk fleksibilitas dan ketenangan pikiran.',
                'status_kebiasaan' => 'Hidup Sehat',
                'durasi' => '30 Menit',
                'intensitas' => 'Ringan',
                'lokasi' => 'Dalam Ruangan',
                'gambar' => 'yoga.jpg',
            ],

            [
                'nama' => 'Renang',
                'deskripsi' => 'Olahraga air yang efektif membakar kalori tanpa membebani sendi.',
                'status_kebiasaan' => 'Hidup Sehat',
                'durasi' => '45-60 Menit',
                'intensitas' => 'Sedang',
                'lokasi' => 'Kolam Renang',
                'gambar' => 'renang.jpg',
            ],

            [
                'nama' => 'Latihan Beban Ringan',
                'deskripsi' => 'Angkat beban ringan 2-3 kali seminggu untuk membangun massa otot.',
                'status_kebiasaan' => 'Kurang Sehat',
                'durasi' => '30-40 Menit',
                'intensitas' => 'Sedang',
                'lokasi' => 'Gym / Dalam Ruangan',
                'gambar' => 'latihan_beban.jpg',
            ],

            [
                'nama' => 'Bersepeda',
                'deskripsi' => 'Gowes 30-45 menit untuk latihan kardio dan membakar lemak.',
                'status_kebiasaan' => 'Hidup Sehat',
                'durasi' => '30-45 Menit',
                'intensitas' => 'Sedang',
                'lokasi' => 'Luar Ruangan',
                'gambar' => 'bersepeda.jpg',
            ],

            [
                'nama' => 'Senam Aerobik',
                'deskripsi' => 'Gerakan dinamis selama 30 menit untuk meningkatkan stamina.',
                'status_kebiasaan' => 'Hidup Sehat',
                'durasi' => '30 Menit',
                'intensitas' => 'Tinggi',
                'lokasi' => 'Studio / Dalam Ruangan',
                'gambar' => 'senam_aerobik.jpg',
            ],

            [
                'nama' => 'Push Up & Sit Up',
                'deskripsi' => 'Latihan badan tanpa alat untuk membangun kekuatan dan massa otot.',
                'status_kebiasaan' => 'Kurang Sehat',
                'durasi' => '15-20 Menit',
                'intensitas' => 'Sedang',
                'lokasi' => 'Dalam Ruangan',
                'gambar' => 'pushup_situp.jpg',
            ],
        ];

        foreach ($activities as $a) {
            PhysicalActivity::create($a);
        }
    }
}
