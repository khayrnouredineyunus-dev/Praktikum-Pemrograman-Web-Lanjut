<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'nama'    => 'Khayr Nouredine Yunus',
        'peran'   => 'Mahasiswa D-IV Teknologi Rekayasa Perangkat Lunak',
        'ringkas' => 'Mahasiswa Teknik Rekayasa Perangkat Lunak di Sekolah Vokasi Universitas Gadjah Mada dengan minat pada pengembangan perangkat lunak secara menyeluruh, mulai dari aplikasi web, aplikasi mobile, hingga perancangan basis data. Terbiasa mengerjakan proyek individu maupun tim, termasuk kompetisi pengembangan perangkat lunak tingkat nasional, dengan fokus pada praktik rekayasa perangkat lunak yang baik dari tahap desain hingga pengujian.',
    ]);
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'nama'    => 'Khayr Nouredine Yunus',
        'asal'    => 'Yogyakarta',
        'minat'   => ['Pengembangan web', 'Project Manager', 'Pemrograman perangkat bergerak'],
    ]);
})->name('about');

Route::get('/education', function () {
    $pendidikan = [
        [
            'jenjang' => 'D-IV Teknologi Rekayasa Perangkat Lunak',
            'instansi' => 'Sekolah Vokasi, Universitas Gadjah Mada',
            'tahun' => '2025 - sekarang',
            'catatan' => 'Mempelajari rekayasa perangkat lunak secara menyeluruh, meliputi pengembangan aplikasi web, mobile, dan basis data.',
        ],
        [
            'jenjang' => 'Sekolah Menengah Atas',
            'instansi' => 'SMA Muhammadiyah 11 Jakarta',
            'tahun' => '2022 - 2025',
            'catatan' => 'Jurusan MIPA.',
        ],
    ];

    return view('education', compact('pendidikan'));
})->name('education');

Route::get('/projects', function () {
    $projects = [
        [
            'judul' => 'MiniFut Arena',
            'stack' => 'PHP Native, MySQL, PDO',
            'deskripsi' => 'Sistem pemesanan lapangan mini soccer dengan perhitungan harga di sisi server.',
        ],
        [
            'judul' => 'Cleanesia',
            'stack' => 'Flutter, Firebase',
            'deskripsi' => 'Aplikasi pemetaan sampah pesisir berbasis crowdsourcing untuk kompetisi GEMASTIK XIX 2026.',
        ],
        [
            'judul' => 'PANA - Website Kopi Keliling',
            'stack' => 'HTML, CSS, JavaScript',
            'deskripsi' => 'Website usaha kopi keliling PANA, menampilkan menu dan informasi pemesanan.',
        ],
    ];

    return view('projects', compact('projects'));
})->name('projects');
