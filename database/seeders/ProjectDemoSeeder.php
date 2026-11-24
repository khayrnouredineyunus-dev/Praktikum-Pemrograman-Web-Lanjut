<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectDemoSeeder extends Seeder
{
    /**
     * Data contoh untuk menguji pencarian, filter, pengurutan, dan paginasi.
     * Aman dijalankan berulang: data dicocokkan lewat slug.
     */
    public function run(): void
    {
        $kategori = [];
        foreach (['Web', 'Mobile', 'Desktop'] as $nama) {
            $kategori[$nama] = Category::firstOrCreate(
                ['slug' => Str::slug($nama)],
                ['name' => $nama]
            );
        }

        $teknologi = [];
        foreach (['Laravel', 'PHP', 'MySQL', 'JavaScript', 'Tailwind CSS', 'Flutter', 'Firebase', 'Python'] as $nama) {
            $teknologi[$nama] = Technology::firstOrCreate(
                ['slug' => Str::slug($nama)],
                ['name' => $nama]
            );
        }

        // Project lama (dari pertemuan sebelumnya) belum punya kategori, masukkan ke Web.
        Project::whereNull('category_id')->update(['category_id' => $kategori['Web']->id]);

        $data = [
            [
                'judul'     => 'Sistem Informasi Perpustakaan',
                'kategori'  => 'Web',
                'stack'     => 'Laravel, MySQL, Bootstrap',
                'ringkas'   => 'Pencatatan buku, anggota, dan peminjaman untuk perpustakaan sekolah.',
                'deskripsi' => 'Aplikasi web untuk mengelola data buku, anggota, dan transaksi peminjaman. Dibangun dengan Laravel dan MySQL, dilengkapi pencarian buku dan laporan peminjaman bulanan.',
                'status'    => 'published',
                'tanggal'   => '2026-03-10',
                'unggulan'  => true,
                'teknologi' => ['Laravel', 'MySQL'],
            ],
            [
                'judul'     => 'Website Profil Kampus',
                'kategori'  => 'Web',
                'stack'     => 'PHP, MySQL, JavaScript',
                'ringkas'   => 'Situs profil program studi dengan halaman berita dan agenda.',
                'deskripsi' => 'Situs informasi program studi yang berisi profil, daftar dosen, berita, dan agenda kegiatan. Konten dikelola lewat halaman admin sederhana.',
                'status'    => 'published',
                'tanggal'   => '2026-01-20',
                'unggulan'  => false,
                'teknologi' => ['PHP', 'MySQL', 'JavaScript'],
            ],
            [
                'judul'     => 'Aplikasi Kasir Toko Kelontong',
                'kategori'  => 'Web',
                'stack'     => 'Laravel, MySQL, Tailwind CSS',
                'ringkas'   => 'Kasir sederhana dengan stok barang dan rekap penjualan harian.',
                'deskripsi' => 'Aplikasi kasir berbasis web untuk toko kecil. Fiturnya mencakup data barang, transaksi penjualan, pengurangan stok otomatis, dan rekap penjualan harian.',
                'status'    => 'published',
                'tanggal'   => '2026-05-02',
                'unggulan'  => true,
                'teknologi' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            ],
            [
                'judul'     => 'Portal Berita Mahasiswa',
                'kategori'  => 'Web',
                'stack'     => 'Laravel, MySQL',
                'ringkas'   => 'Portal berita kegiatan mahasiswa dengan kategori dan komentar.',
                'deskripsi' => 'Portal berita yang ditulis dan dikelola mahasiswa. Setiap artikel punya kategori, penulis, dan kolom komentar yang dimoderasi admin.',
                'status'    => 'published',
                'tanggal'   => '2026-06-15',
                'unggulan'  => false,
                'teknologi' => ['Laravel', 'MySQL'],
            ],
            [
                'judul'     => 'Dashboard Penjualan',
                'kategori'  => 'Web',
                'stack'     => 'Laravel, JavaScript, Tailwind CSS',
                'ringkas'   => 'Grafik penjualan per bulan dan per produk.',
                'deskripsi' => 'Dashboard yang menampilkan ringkasan penjualan dalam bentuk kartu angka dan grafik. Data diambil dari database lewat query agregat.',
                'status'    => 'published',
                'tanggal'   => '2026-07-08',
                'unggulan'  => false,
                'teknologi' => ['Laravel', 'JavaScript', 'Tailwind CSS'],
            ],
            [
                'judul'     => 'Toko Online Batik',
                'kategori'  => 'Web',
                'stack'     => 'PHP, MySQL, JavaScript',
                'ringkas'   => 'Katalog dan keranjang belanja untuk produk batik.',
                'deskripsi' => 'Toko online dengan katalog produk, keranjang belanja, dan halaman pemesanan. Pembayaran masih berupa konfirmasi manual.',
                'status'    => 'published',
                'tanggal'   => '2025-11-30',
                'unggulan'  => false,
                'teknologi' => ['PHP', 'MySQL', 'JavaScript'],
            ],
            [
                'judul'     => 'Landing Page Kopi Lokal',
                'kategori'  => 'Web',
                'stack'     => 'JavaScript, Tailwind CSS',
                'ringkas'   => 'Halaman promosi satu halaman untuk kedai kopi.',
                'deskripsi' => 'Landing page statis dengan galeri menu, lokasi, dan tombol pesan lewat WhatsApp. Tampilan responsif untuk layar ponsel.',
                'status'    => 'published',
                'tanggal'   => '2025-10-12',
                'unggulan'  => false,
                'teknologi' => ['JavaScript', 'Tailwind CSS'],
            ],
            [
                'judul'     => 'API Katalog Buku',
                'kategori'  => 'Web',
                'stack'     => 'Laravel, MySQL',
                'ringkas'   => 'REST API untuk data buku, penulis, dan penerbit.',
                'deskripsi' => 'Layanan API yang menyediakan data buku dalam format JSON. Dibuat dengan Laravel dan dipakai sebagai latihan sebelum membuat aplikasi klien.',
                'status'    => 'published',
                'tanggal'   => '2026-08-21',
                'unggulan'  => false,
                'teknologi' => ['Laravel', 'MySQL'],
            ],
            [
                'judul'     => 'Aplikasi Absensi Kelas',
                'kategori'  => 'Web',
                'stack'     => 'Laravel, MySQL, JavaScript',
                'ringkas'   => 'Absensi mahasiswa per pertemuan dengan rekap kehadiran.',
                'deskripsi' => 'Dosen membuat sesi pertemuan, mahasiswa mengisi kehadiran, lalu sistem menghitung persentase kehadiran setiap mahasiswa.',
                'status'    => 'published',
                'tanggal'   => '2026-09-05',
                'unggulan'  => false,
                'teknologi' => ['Laravel', 'MySQL', 'JavaScript'],
            ],
            [
                'judul'     => 'Aplikasi Reservasi Lapangan',
                'kategori'  => 'Web',
                'stack'     => 'PHP, MySQL',
                'ringkas'   => 'Pemesanan jadwal lapangan futsal dan badminton.',
                'deskripsi' => 'Pengguna memilih lapangan, tanggal, dan jam. Sistem menolak jadwal yang bentrok dengan reservasi lain.',
                'status'    => 'published',
                'tanggal'   => '2026-04-18',
                'unggulan'  => false,
                'teknologi' => ['PHP', 'MySQL'],
            ],
            [
                'judul'     => 'Aplikasi Catatan Harian',
                'kategori'  => 'Mobile',
                'stack'     => 'Flutter, Firebase',
                'ringkas'   => 'Catatan harian dengan penyimpanan di cloud.',
                'deskripsi' => 'Aplikasi mobile untuk menulis catatan harian. Data disimpan di Firebase sehingga bisa dibuka dari beberapa perangkat.',
                'status'    => 'published',
                'tanggal'   => '2026-02-14',
                'unggulan'  => false,
                'teknologi' => ['Flutter', 'Firebase'],
            ],
            [
                'judul'     => 'Aplikasi Pengingat Tugas',
                'kategori'  => 'Mobile',
                'stack'     => 'Flutter, Firebase',
                'ringkas'   => 'Daftar tugas kuliah dengan pengingat tenggat.',
                'deskripsi' => 'Aplikasi mobile untuk mencatat tugas kuliah beserta tenggatnya. Notifikasi muncul satu hari sebelum tenggat.',
                'status'    => 'published',
                'tanggal'   => '2026-10-01',
                'unggulan'  => false,
                'teknologi' => ['Flutter', 'Firebase'],
            ],
            // Tiga project draft: tidak boleh tampil untuk pengunjung.
            [
                'judul'     => 'Game Tebak Angka',
                'kategori'  => 'Desktop',
                'stack'     => 'Python',
                'ringkas'   => 'Permainan tebak angka berbasis desktop.',
                'deskripsi' => 'Prototipe permainan tebak angka dengan tingkat kesulitan berbeda. Masih dalam pengerjaan.',
                'status'    => 'draft',
                'tanggal'   => '2026-10-20',
                'unggulan'  => false,
                'teknologi' => ['Python'],
            ],
            [
                'judul'     => 'Sistem Antrian Bengkel',
                'kategori'  => 'Web',
                'stack'     => 'Laravel, MySQL',
                'ringkas'   => 'Nomor antrian dan status servis kendaraan.',
                'deskripsi' => 'Pelanggan mengambil nomor antrian dan memantau status servis kendaraan. Belum selesai diuji.',
                'status'    => 'draft',
                'tanggal'   => '2026-11-05',
                'unggulan'  => false,
                'teknologi' => ['Laravel', 'MySQL'],
            ],
            [
                'judul'     => 'Aplikasi Kuis Interaktif',
                'kategori'  => 'Mobile',
                'stack'     => 'Flutter, Firebase',
                'ringkas'   => 'Kuis pilihan ganda dengan papan skor.',
                'deskripsi' => 'Kuis pilihan ganda dengan skor akhir dan papan peringkat. Soal masih berupa data contoh.',
                'status'    => 'draft',
                'tanggal'   => '2026-11-12',
                'unggulan'  => false,
                'teknologi' => ['Flutter', 'Firebase'],
            ],
        ];

        $jumlah = count($data);

        foreach ($data as $urutan => $item) {
            $project = Project::firstOrNew(['slug' => Str::slug($item['judul'])]);

            $project->forceFill([
                'judul'             => $item['judul'],
                'category_id'       => $kategori[$item['kategori']]->id,
                'stack'             => $item['stack'],
                'short_description' => $item['ringkas'],
                'deskripsi'         => $item['deskripsi'],
                'status'            => $item['status'],
                'project_date'      => $item['tanggal'],
                'is_featured'       => $item['unggulan'],
            ]);

            // Tanggal pembuatan dibedakan supaya urutan "terbaru" dan "terlama" terlihat.
            if (! $project->exists) {
                $project->created_at = now()->subDays($jumlah - $urutan);
            }

            $project->save();

            $project->technologies()->sync(
                collect($item['teknologi'])->map(fn ($nama) => $teknologi[$nama]->id)->all()
            );
        }
    }
}
