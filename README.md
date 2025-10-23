# Timedoor Backend Programming Exam

Proyek ujian backend **Timedoor**.  
Dibangun menggunakan **Laravel 12.35.0** dan **PHP 8.2.12**, proyek ini berfokus pada logika backend untuk menampilkan:
- Daftar buku berdasarkan rating tertinggi  
- 10 penulis terpopuler  
- Fitur input rating  

Data dummy dihasilkan otomatis menggunakan **Faker** sesuai ketentuan ujian:
- 1.000 penulis  
- 3.000 kategori buku  
- 100.000 buku  
- 500.000 rating  

---

## Teknologi yang Digunakan
- **Laravel 12.35.0**
- **PHP 8.2.12**
- **MySQL**
- **Composer**
- **Faker (untuk data dummy)**

---

## Cara Menjalankan Proyek

1. **Clone Repository**

       git clone https://github.com/username/nama-repo.git
       cd nama-repo
   
4. **Install Dependencies**

       Composer install

6. **Salin File .env**

       cp .env.example .env

8. **Generate APP_KEY**

       php artisan key:generate

10. **Atur Konfigurasi Database**
    Buka file .env, lalu sesuaikan bagian berikut:
        
        DB_DATABASE=timedoor_backend_exam
        DB_USERNAME=root
        DB_PASSWORD=

12. **Jalankan Migrasi dan Seeder**

        php artisan migrate --seed

14. **Jalankan Server**

        php artisan serve

## Route / Endpoint Penting ##

GET /
Halaman daftar buku (param: limit default 10, search)

GET /top-authors
Halaman 10 penulis terpopuler (hitung voter rating > 5)

GET /add-rating
Form input rating (pilih author → book → rating)

POST /add-rating
Simpan rating baru

GET /books-by-author/{authorId}
API JSON untuk mendapatkan buku berdasarkan author (dipakai AJAX pada form)

