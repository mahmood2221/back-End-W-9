
# Laravel Product CRUD – Task 04

## 📌 Project Overview

This project is a **Laravel Product CRUD application** that demonstrates  **basic database operations** ,  **form validation** , and **database integrity enforcement** following clean code standards.

The project was developed as part of  **Task 04: Product Validation & Data Integrity in Laravel** .

---

## 🚀 Features

* Create, Read, Update, Delete (CRUD) Products
* Server-side validation using **Laravel Form Requests**
* Database integrity using **migration constraints**
* Clear validation error messages in views
* Preserves old input values on validation failure

---

## 🛠️ Technologies Used

* PHP 8+
* Laravel 10+
* MySQL
* Blade Templates
* Git & GitHub

---

## 📂 Validation Rules

### Store Product

* `name` → required, unique
* `price` → required, numeric, greater than 0

### Update Product

* Same validation rules
* Unique name ignores current product ID

---

## 🗄️ Database Structure

```sql
products
- id (primary key)
- name (string, unique)
- price (decimal 8,2)
- timestamps
```

---

## ⚙️ Installation & Setup

```bash
git clone https://github.com/mahmood2221/back-End-W-3.git
cd myproject
composer install
cp .env.example .env
php artisan key:generate
```

### Configure Database

Update `.env` with your database credentials.

### Run Migrations & Seeders

```bash
php artisan migrate:fresh --seed
```

### Run the Project

```bash
php artisan serve
```

Open:

```
http://127.0.0.1:8000/products
```

---

## ✅ Validation Testing Checklist

* Empty name → ❌ validation fails
* Duplicate name → ❌ validation fails
* Price ≤ 0 → ❌ validation fails
* Update without changing name → ✅ passes
* Update with duplicate name → ❌ fails

---

## 📸 Screens

Validation errors appear:

* Under each input field
* As a summary list at the top of the form

---

## 👨‍💻 Author

Mahmood

---

## 🏁 Final Notes

This project follows **Laravel best practices** and is ready for production-level validation handling.
