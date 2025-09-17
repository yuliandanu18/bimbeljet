# Panduan Push ke GitHub (yuliandanu18)

## Opsi A — GitHub CLI (direkomendasikan)
```bash
git init
git add .
git commit -m "feat: manual payments + invoices UI + attendance + migration reorder + seeders"
git branch -M main
gh repo create yuliandanu18/bimbeljet --public --source=. --remote=origin --push
```

## Opsi B — HTTPS (tanpa GitHub CLI)
1. Buat repo kosong di GitHub: **yuliandanu18/bimbeljet**.
2. Jalankan:
```bash
git init
git add .
git commit -m "feat: manual payments + invoices UI + attendance + migration reorder + seeders"
git branch -M main
git remote add origin https://github.com/yuliandanu18/bimbeljet.git
git push -u origin main
```

## Catatan
- Pastikan file `.env`, `vendor/`, `node_modules/` **ter-ignore** (cek `.gitignore` dalam paket ini).
- Setelah push, buat **Release v0.2.0** di GitHub bila perlu.
