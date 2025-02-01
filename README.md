1. Download & Install Laragon / Xampp
   Unduh Laragon dari situs resminya:
   🔗 https://laragon.org/download/

Install Laragon seperti software biasa.

Pilih lokasi instalasi (default: C:\laragon).
Pastikan opsi "Add Laragon to PATH" dicentang untuk mempermudah akses dari terminal.
Klik Next dan tunggu proses instalasi selesai.
Buka Laragon (As Administrator) dan klik tombol Start All untuk menjalankan Apache & MySQL.
(Versi PHP pada project menggunakan versi PHP 8.1)

2. Pindahkan project ke dalam folder laragon/www.
3. Jalankan command npm install dan composer install (pastikan sudah menginstall composer) pada terminal.
4. Export database yang ada pada root project (herca-test.sql) atau bisa menjalankan command php artisan migrate:fresh --seed (dengan data dummy).
5. Export postman collection root project (Herca Test.postman_collection.json).
6. Jalankan npm run dev & php artisan serve di 2 terminal berbeda untuk menjalankan project.
