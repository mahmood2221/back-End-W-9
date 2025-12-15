`https://github.com/mahmood2221/back-End-W-3`

# Laravel Basic Database Operations – Product CRUD

## 📌 Task03(2): Product CRUD Operations in Laravel

This project demonstrates **basic database operations (CRUD)** in Laravel using a **Product** model. It includes migrations, seeders, controllers, routes, and views to manage products.

---

## 🚀 Requirements

* PHP 8.1+
* Composer
* Laravel 10+
* MySQL (or any supported database)
* Git

---

## ⚙️ Installation & Setup

### 1️⃣ Clone the repository

```bash
git clone https://github.com/mahmood2221/back-End-W-3.git
cd myproject
```

### 2️⃣ Install dependencies

```bash
composer install
```

### 3️⃣ Environment configuration

Copy the environment file:

```bash
cp .env.example .env
```

Update database credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Generate application key

```bash
php artisan key:generate
```

---

## 🛠️ Database Setup

### Run migrations

```bash
php artisan migrate
```

### Seed the database (insert dummy products)

```bash
php artisan db:seed --class=ProductSeeder
```

> This will insert **at least 5 dummy products** into the `products` table.

---

## ▶️ Run the Application

```bash
php artisan serve
```

Open your browser:

```
http://127.0.0.1:8000
```

The  **products list will appear on the home page** .

---

## 🔗 Available Routes

| Method | URL                     | Description          |
| ------ | ----------------------- | -------------------- |
| GET    | `/`                   | Display all products |
| GET    | `/products`           | Display all products |
| GET    | `/products/create`    | Add new product      |
| POST   | `/products`           | Store product        |
| GET    | `/products/{id}/edit` | Edit product         |
| PUT    | `/products/{id}`      | Update product       |
| DELETE | `/products/{id}`      | Delete product       |

---

## 🧪 Verify Using Tinker

```bash
php artisan tinker
```

```php
App\\Models\\Product::all();
```

---

## 📂 Project Structure (Important Files)

* `app/Models/Product.php`
* `database/migrations/create_products_table.php`
* `database/seeders/ProductSeeder.php`
* `app/Http/Controllers/ProductController.php`
* `routes/web.php`
* `resources/views/products/`

---

## 🔐 Notes

* `$fillable` is used in the `Product` model for  **Mass Assignment protection** .
* Always run  **migrations before seeders** .
* CRUD operations are implemented using `Route::resource`.

---

## ✅ Expected Outcome

* Products table created with fields: `id`, `name`, `price`, `created_at`, `updated_at`
* Five dummy products inserted
* Fully functional CRUD operations (Create, Read, Update, Delete)

---

## 👤 Author

**Mahmood**

---

✅ This project is ready for academic submission and evaluation.
