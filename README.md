# DAILYDRINK — Project Notes

E-Commerce kopi & minuman kekinian (Gen Z). Dibangun sesuai `prd.md` dari project Laravel 13 yang sudah ada.

## Stack
- Laravel 13 + Blade + Tailwind CSS v4 (Vite)
- Database: SQLite (`database/database.sqlite`)
- Authentication: manual (login, register, logout, forgot/reset password)
- Payment: **Mock Midtrans Snap** (struktur kompatibel untuk switch ke asli)

## Akun Demo
| Role     | Email               | Password |
| -------- | ------------------- | -------- |
| Admin    | admin@dailydrink.id | password |
| Customer | demo@dailydrink.id  | password |

## Cara Menjalankan
```powershell
php artisan serve
npm run dev        # opsional, hot reload frontend
```
Seed awal: 5 kategori + 8 produk (American, Caramel Macchiato, dll) jalan otomatis saat migrasi.

## Struktur Utama
```
app/Http/Controllers/        Home, Product, Cart, Checkout, Order, Payment, Profile, Auth + Admin/*
app/Services/MidtransService.php   service payment (mock/snap)
app/Models/                  User, Category, Product, Cart, CartItem, Order, OrderItem
database/migrations/         tabel e-commerce (categories, products, carts, cart_items, orders, order_items)
resources/views/             layouts, home, shop, products, cart, checkout, orders, profile, auth, admin
routes/web.php               semua route public/auth/admin + POST /payment/notification
```

## Alur Utama
Browse → Shop → Product Detail → Add to Cart → Checkout → Create Order → Mock Payment → Payment Notification → Order Status

## Alur Payment (Mock)
1. Checkout membuat Order dengan status `pending/pending` + `snap_token` `MOCK-*`.
2. Halaman `/checkout/pay/{order_number}` menampilkan tombol simulasi: **Berhasil / Pending / Gagal / Expired**.
3. Hasil disimpan ke order (payment_status & order_status terpisah) seperti layaknya notification Midtrans.
4. Endpoint nyata `POST /payment/notification` tetap tersedia & tanpa login, untuk verifikasi backend.

### Switch ke Midtrans Asli
```powershell
composer require midtrans/midtrans-php
```
Lalu di `.env`:
```env
MIDTRANS_MODE=snap
MIDTRANS_SERVER_KEY=isi_server_key_sandbox
MIDTRANS_CLIENT_KEY=isi_client_key_sandbox
MIDTRANS_IS_PRODUCTION=false
```
`MidtransService` sudah punya jalur `snap`, jadi route/tabel tidak perlu diubah.

## Status
| Payment | Pending, Paid, Failed, Expired, Cancelled |
| ------- | ----------------------------------------- |
| Order   | Pending, Processing, Ready, Completed, Cancelled |

## Halaman & Akses
| Halaman              | Akses   |
| -------------------- | ------- |
| Home, Shop, Product Detail, Login, Register | Publik |
| Cart, Checkout, Orders, Profile | Login customer |
| `/admin/*` (dashboard, produk, kategori, orders, customers) | Login admin |

## Fitur Lengkap (ringkas)
- Homepage: hero "Your Daily Drink, Your Daily Mood.", kategori, best seller, promo Weekend Deal, brand section.
- Shop: search, filter kategori, sort terbaru/best seller/termurah/termahal.
- Product detail: qty, Add to Cart, Buy Now.
- Cart: update qty, hapus item, subtotal.
- Checkout: info customer + delivery + order summary (shipping flat Rp10.000).
- Orders: riwayat + detail per order.
- Profile: ubah nama/HP/alamat + password.
- Admin: dashboard stats, CRUD produk (upload gambar, stok, status, best seller), CRUD kategori, kelola status order, daftar customer.

## Catatan Penting
- Payment dijamin **mock** — tidak ada transaksi uang asli.
- Product & category image memakai placeholder Unsplash bila belum upload.
- Server Key tidak pernah tampil di frontend.
- Semua route admin dilindungi middleware `admin`.
