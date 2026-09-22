<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MencobaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

Route::resource('posts', PostController::class);

Route::get('/mencoba', [MencobaController::class, 'index']);

Route::get('/', function () {
    return view('home', [
        'nama'    => 'Khayr Nouredine Yunus',
        'peran'   => 'Mahasiswa D-IV Teknologi Rekayasa Perangkat Lunak',
        'ringkas' => 'Mahasiswa Teknologi Rekayasa Perangkat Lunak di Sekolah Vokasi Universitas Gadjah Mada dengan minat pada pengembangan perangkat lunak secara menyeluruh, mulai dari aplikasi web, aplikasi mobile, hingga perancangan basis data. Terbiasa mengerjakan proyek individu maupun tim, termasuk kompetisi pengembangan perangkat lunak, dengan fokus pada praktik rekayasa perangkat lunak yang baik dari tahap desain hingga pengujian.',
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


