<<<<<<< HEAD
# tugas-week6-api (Laravel)

RESTful API sederhana untuk resource `students`.

## Requirements

- PHP >= 8.2
- Composer
- MySQL (XAMPP)

## Setup & Run (Windows CMD)

1. Masuk ke folder project:
   - `cd /d C:\xampp\htdocs\Laravel\tugas-week6-api`
2. Install dependency (jika belum):
   - `composer install`
3. Buat database di phpMyAdmin:
   - `week6_iae`
4. Pastikan `.env` sudah sesuai (DB MySQL XAMPP), lalu jalankan:
   - `php artisan key:generate`
   - `php artisan migrate`
5. Jalankan server:
   - `php artisan serve`

Base URL API: `http://127.0.0.1:8000/api`

## Endpoints

- `GET /api/students` - Ambil semua data
- `GET /api/students/{id}` - Ambil detail
- `POST /api/students` - Tambah data
- `PUT /api/students/{id}` - Update data
- `DELETE /api/students/{id}` - Hapus data

## Request Body (JSON)

POST / PUT:

```json
{
  "name": "Budi Santoso",
  "nim": "22123456",
  "email": "budi@example.com",
  "prodi": "Informatika"
}
```

## Response Format

Sukses:

```json
{
  "success": true,
  "message": "Pesan sesuai aksi",
  "data": {}
}
```

Not found:

```json
{
  "success": false,
  "message": "Student not found"
}
```
=======
>>>>>>> 2555af931a9980db4376c585c1aab3d15145cb56

