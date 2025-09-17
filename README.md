# Manual Payments Pack (Laravel)
Tambahan *drop-in* untuk verifikasi pembayaran manual: owner cek mobile banking → klik status (Pending/Received/Rejected/Cancelled).

## Cara Pasang (Windows/XAMPP friendly)
1. Ekstrak ZIP ini ke **root project Laravel** (merge file bila diminta).
2. Tambahkan 1 baris ini ke **routes/web.php** (paling bawah aman):
   ```php
   require __DIR__.'/payments_review_routes.php';
   ```
3. Jalankan:
   ```bash
   php artisan storage:link
   php artisan migrate
   php artisan route:clear && php artisan route:list
   ```

> Jika sebelumnya kamu sudah membuat migrasi manual dan muncul error "Duplicate column 'status'", hapus/rename migrasi buatanmu itu, lalu jalankan lagi `php artisan migrate`. Migrasi dari paket ini **idempotent** (cek kolom dulu).

## Pakai
- Buat pembayaran dari halaman **invoice** (cash langsung RECEIVED; transfer PENDING).
- Buka **/payments/review** untuk verifikasi.
- Invoice otomatis jadi **paid/partial/unpaid** melihat total yang **received**.
