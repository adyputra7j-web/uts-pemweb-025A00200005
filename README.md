# PlayVault - Website Profil Kolektor & Katalog Koleksi Game PlayStation 2 & 3

Proyek Mini Individu Ujian Tengah Semester (UTS)  
**Mata Kuliah:** Pemrograman Web (253A23W15)  
**Program Studi:** S1 Informatika — Fakultas Teknik  
**Institusi:** Tiga Serangkai University  

---

## 1. Identitas Mahasiswa

- **Nama Lengkap:** Ahmad Ady Saputra
- **NIM:** 025A00200000 *(Silakan sesuaikan digit NIM Anda di data.php)*
- **Kelas:** Informatika 2025 (253A23W15)
- **Tautan Repositori GitHub:** `https://github.com/adyputra7j-web/uts-pemweb-[NIM]`

---

## 2. Deskripsi Singkat Tema

Website **PlayVault** merupakan sistem informasi profil dan katalog arsip digital koleksi video game era keemasan konsol **PlayStation 2 (PS2)** dan **PlayStation 3 (PS3)** paling terkenal dan berpengaruh sepanjang masa. Melalui platform ini, pengunjung dapat melihat profil sang kolektor, riwayat bermain, serta statistik total durasi permainan, agregasi per konsol (6 judul PS2 & 6 judul PS3), dan menelusuri katalog game yang dilengkapi fitur penyaringan konsol, genre, status penyelesaian, pencarian kata kunci, serta pengurutan rating secara interaktif. Seluruh data dikelola menggunakan struktur array PHP multidimensi tanpa basis data eksternal sesuai pedoman teknis UTS.

---

## 3. 📷 Panduan Memasukkan Foto Game Sendiri

Proyek ini telah dilengkapi dengan tanda (*placeholder*) dan penanda khusus agar Anda dapat dengan sangat mudah memasukkan foto game asli Anda sendiri:

1. **Siapkan Foto Game Anda:**
   - Siapkan file gambar cover game (bisa berformat `.jpg`, `.png`, `.jpeg`, atau `.webp`).
   - Berikan nama file yang jelas, misalnya: `gta-san-andreas.jpg`, `god-of-war.png`, dll.
2. **Pindahkan Foto ke Folder:**
   - Salin file gambar Anda ke dalam folder:  
     📂 `assets/images/`
3. **Ubah Jalur File di `data.php`:**
   - Buka file `data.php`, cari bagian game yang ingin Anda ganti fotonya.
   - Perhatikan baris komentar yang bertanda:  
     `// [TANDA: GANTI DENGAN FOTO SENDIRI DI SINI]`
   - Ganti isi atribut `'gambar'`, contoh:
     ```php
     // SEBELUMNYA:
     'gambar' => 'assets/images/ps2-gta-san-andreas.svg',

     // SESUDAH DIGANTI FOTO ASLI ANDA:
     'gambar' => 'assets/images/gta-san-andreas.jpg',
     ```
4. **Refresh Browser:**
   - Buka kembali peramban Anda, maka foto cover asli Anda akan langsung otomatis tampil di halaman Profil dan Katalog!

---

## 4. Cara Menjalankan di Localhost

Proyek ini dibangun murni menggunakan **PHP Native** dan **CSS Kustom** tanpa dependensi luar. Karena Anda menggunakan **Laragon**, Anda dapat menjalankannya dengan sangat mudah:

### Opsi A: Menggunakan Laragon (Sudah Terpasang & Aktif!)
Folder proyek ini telah berada langsung di direktori root Laragon Anda:
```text
C:\laragon\www\mygamevault\
```

1. **Pastikan Laragon Berjalan:**
   - Buka aplikasi **Laragon** Anda.
   - Klik tombol **Start All** (jika belum aktif).
2. **Langsung Buka di Browser Anda:**
   - **Melalui Pretty URL Laragon:**
     - Halaman Profil: [http://mygamevault.test](http://mygamevault.test) atau [http://mygamevault.test/index.php](http://mygamevault.test/index.php)
     - Halaman Katalog: [http://mygamevault.test/katalog.php](http://mygamevault.test/katalog.php)
   - **Atau Melalui Localhost:**
     - Halaman Profil: [http://localhost/mygamevault/index.php](http://localhost/mygamevault/index.php)
     - Halaman Katalog: [http://localhost/mygamevault/katalog.php](http://localhost/mygamevault/katalog.php)

> 💡 **Terminal Laragon untuk Git Commit:**
> Klik tombol **Terminal** pada jendela utama Laragon (Cmder). Di terminal ini, `git` (`C:\laragon\bin\git`) dan `php` sudah otomatis aktif dan siap digunakan untuk menjalankan 5 commit bertahap!

---

### Opsi B: Menggunakan PHP Built-in Server (Lewat Terminal Laragon)
1. Buka tombol **Terminal** pada aplikasi Laragon (Cmder).
2. Masuk ke direktori folder proyek:
   ```bash
   cd uts-pemweb-koleksi-game
   ```
3. Jalankan server lokal:
   ```bash
   php -S localhost:8000
   ```
4. Buka browser: `http://localhost:8000/index.php`

---

### Opsi C: Menggunakan XAMPP (Alternatif)
Jika dijalankan di komputer kampus/teman yang menggunakan XAMPP:
1. Pindahkan folder ke `C:\xampp\htdocs\uts-pemweb-[NIM]`.
2. Aktifkan modul Apache pada XAMPP Control Panel.
3. Akses via browser: `http://localhost/uts-pemweb-[NIM]/index.php`

---

## 5. Daftar 12 Game PS2 & PS3 di dalam Data

Katalog memuat **12 judul legendaris** (melampaui syarat minimal 8 item) dengan 11 atribut lengkap:

### Kategori PlayStation 2 (PS2):
1. **Grand Theft Auto: San Andreas** (2004) - Open World Action &bull; Rockstar Games
2. **God of War II** (2007) - Hack and Slash &bull; Santa Monica Studio
3. **Resident Evil 4** (2005) - Survival Horror &bull; Capcom
4. **Shadow of the Colossus** (2005) - Action Adventure &bull; Team Ico / Sony
5. **Need for Speed: Most Wanted** (2005) - Racing &bull; EA Black Box
6. **Bully (Canis Canem Edit)** (2006) - Action Adventure &bull; Rockstar Games

### Kategori PlayStation 3 (PS3):
7. **The Last of Us** (2013) - Action Survival &bull; Naughty Dog / Sony
8. **Grand Theft Auto V** (2013) - Open World Action &bull; Rockstar Games
9. **God of War III** (2010) - Hack and Slash &bull; Santa Monica Studio
10. **Uncharted 2: Among Thieves** (2009) - Action Adventure &bull; Naughty Dog
11. **Red Dead Redemption** (2010) - Open World Action &bull; Rockstar Games
12. **Metal Gear Solid 4: Guns of the Patriots** (2008) - Stealth Action &bull; Konami

---

## 6. Daftar Fitur & Penanggung Jawab Kode

| No | Fitur | File Terkait | Fungsi / Logika Pemroses | Penjelasan Singkat |
|:---|:---|:---|:---|:---|
| 1 | **Sanitasi Output (Anti-XSS)** | `functions.php` | `e(string $value): string` | Membungkus `htmlspecialchars()` untuk memastikan seluruh data yang dicetak ke HTML aman dari injeksi skrip. |
| 2 | **Label Badge Status Dinamis** | `functions.php` | `getStatusBadge(string $status): string` | Menggunakan ekspresi `match` PHP 8 untuk mengubah warna badge status (*Tamat*, *Sedang Dimainkan*, *Backlog*). |
| 3 | **Badge Konsol Khusus** | `functions.php` | `getPlatformBadge(string $platform): string` | Menampilkan label bergaya otentik untuk konsol PlayStation 2 dan PlayStation 3. |
| 4 | **Format Bintang & Skor** | `functions.php` | `formatRatingStars(float $rating): string` | Mengonversi skor numerik ke dalam bentuk visualisasi 5 bintang emas (`★` / `☆`). |
| 5 | **Agregasi Statistik Koleksi** | `functions.php` | `getCollectionStats(array $games): array` | Menghitung total judul, total jam main, rata-rata skor, rasio per konsol (PS2 vs PS3), persentase tamat, dan game tertinggi. |
| 6 | **Penyaringan Multi-Kriteria** | `functions.php` | `filterGames(...)` | Menyaring data berdasarkan kata kunci judul/pengembang, konsol platform, genre, dan status penyelesaian. |
| 7 | **Pengurutan Data (Sorting)** | `functions.php` | `sortGames(...)` | Mengurutkan koleksi secara fleksibel berdasarkan rating, tahun rilis, durasi main, atau abjad judul menggunakan `usort`. |
| 8 | **Render Dinamis Foreach** | `katalog.php` | Perulangan `foreach` | Menghasilkan elemen kartu semantik `<article class="game-card">` secara otomatis dari array data. |
| 9 | **Pemberitahuan Hasil Kosong** | `katalog.php` | Percabangan `if ($totalDisplayed === 0)` | Menampilkan tampilan antarmuka ramah (*empty state*) ketika kombinasi pencarian tidak menemukan hasil. |

---

## 7. Fungsi Array Bawaan PHP yang Digunakan

Mengimplementasikan **6 fungsi bawaan array**:
1. **`count()`**: Menghitung total judul game dan hasil pencarian.
2. **`array_column()`**: Mengekstraksi kolom data seperti `jam_bermain`, `rating`, `platform`, dan `genre`.
3. **`array_sum()`**: Menjumlahkan total jam bermain dan nilai rating untuk menghitung rata-rata skor.
4. **`array_filter()`**: Menyaring status permainan, menyaring per konsol (PS2/PS3), serta menyaring kata kunci pencarian.
5. **`usort()`**: Mengurutkan array game menggunakan fungsi callback dan spaceship operator (`<=>`).
6. **`array_unique()`**: Mengambil daftar genre dan platform konsol unik untuk dropdown filter otomatis.

---

## 8. Panduan Riwayat Commit Git (Minimal 5 Commit Bertahap)

Jalankan perintah berikut di terminal folder proyek Anda secara bertahap:

```bash
# Inisialisasi Git
git init
git branch -M main

# TAHAP 1: Rancang (Tema PS2 & PS3, struktur folder, .gitignore, README)
git add .gitignore README.md assets/
git commit -m "feat(init): inisialisasi struktur proyek tema game ps2 ps3 dan readme awal"

# TAHAP 2: Kerangka Antarmuka Semantik & Desain CSS Kustom
git add style.css
git commit -m "feat(ui): implementasi kerangka semantik html5 dan styling dark vault responsif"

# TAHAP 3.1: Logika Data Multidimensi & Fungsi Strict Types
git add data.php functions.php
git commit -m "feat(logic): tambah 12 data game ps2/ps3 dan fungsi helper agregasi strict types"

# TAHAP 3.2: Integrasi Render Foreach, Filter Platform & Pencarian
git add index.php katalog.php
git commit -m "feat(catalog): integrasi render dinamis foreach dengan filter konsol ps2/ps3 dan sort"

# TAHAP 4: Refaktor Clean Code PSR-12 & Penanda Gambar Mandiri
git add .
git commit -m "refactor(final): penyempurnaan clean code psr-12 dan panduan penggantian foto game"

# Hubungkan ke repositori GitHub publik Anda (sesuaikan nama repo jika berbeda)
git remote add origin https://github.com/adyputra7j-web/uts-pemweb-[NIM].git
git push -u origin main
```

---

## 9. Lembar Persiapan Uji Demo Dosen (5 Menit)

Berikut bocoran instruksi yang sering diajukan dosen penguji saat demo langsung:

1. **Dosen meminta menambah 1 game baru:**
   - Buka `data.php`, salin satu blok array di `$koleksiGame`, ubah `'id' => 13`, masukkan judul game baru (misal: *Tekken 5*), lalu simpan. Refresh browser, game akan langsung muncul tanpa mengubah HTML!
2. **Dosen meminta mengubah warna badge status:**
   - Buka `functions.php` pada fungsi `getStatusBadge()`. Anda cukup mengubah string kelas CSS pada ekspresi `match`.
3. **Dosen meminta menjelaskan fungsi array bawaan:**
   - Tunjukkan fungsi `getCollectionStats()` di `functions.php`. Jelaskan bahwa `array_column()` mengambil seluruh angka jam main, lalu `array_sum()` menjumlahkannya secara efisien.
