# Changelog

## [0.2.0] - 2025-09-17
### Added
- **Manual payments workflow**:
  - Kolom baru di `payments`: `status` (`pending|received|rejected|cancelled`), `bank_name`, `bank_ref`, `proof_path`, `verified_by`, `verified_at`, `notes` (migrasi idempotent).
  - Panel verifikasi owner: `GET /payments/review`, `GET /payments/{payment}`, `POST /payments/{payment}/status`.
  - Upload bukti transfer (disk `public`).
- **Invoices**:
  - Routes: `invoices.index`, `invoices.show`, `invoices.pay`.
  - Views: `resources/views/invoices/index.blade.php`, `resources/views/invoices/show.blade.php` (single form + upload + riwayat).
  - `PaymentController@store`: `cash` ⇒ `received`, `transfer/gateway` ⇒ `pending`, lalu hitung ulang status invoice (`paid/partial/unpaid`).
- **Absensi**:
  - Tabel `attendances` + route `GET /attend/{enrollment}` (QR-friendly).
- **Komponen Blade**:
  - `resources/views/components/layouts/app.blade.php` (layout Tailwind + @vite)
  - `resources/views/components/card.blade.php`

### Changed
- Perbaikan urutan migrasi: `packages/students/tutors` **sebelum** `classes` untuk hindari error FK.

### Fixed
- FK error `errno:150` pada `classes` → dibenahi lewat reorder migrasi.
- Layout & komponen hilang (`<x-layouts.app>`, `<x-card>`) → ditambahkan.

### Notes
- Jalankan `php artisan storage:link` (jika `already exists` aman diabaikan).
- Set `APP_URL=http://localhost:8000` saat lokal untuk URL bukti yang rapi.
