
# Task 05: Eloquent Relationships & Category Association (Laravel)

## Objective

Enhance the Product Management System by introducing a relational database structure.
This task demonstrates how to implement **One-to-Many Eloquent Relationships** in Laravel
between **Categories** and **Products**, with proper validation, migrations, and seeders.

---

## Technologies Used

- PHP 8.x
- Laravel 10.x
- MySQL
- Blade Templates
- Eloquent ORM

---

## Features Implemented

### Category Module

- Category Model & Migration
- `categories` table with:
  - `id`
  - `name` (unique)
  - timestamps
- CategorySeeder inserts **5 categories**:
  - Electronics
  - Fashion
  - Home
  - Books
  - Sports

---

### Product Module Enhancements

- Added `category_id` column to `products` table
- Foreign key constraint:
  - References `categories.id`
  - `onDelete('cascade')`
- Each product belongs to one category

---

### Eloquent Relationships

**Product Model**

public function category()
{
    return $this->belongsTo(Category::class);
}
Category Model


public function products()
{
    return $this->hasMany(Product::class);
}
 CRUD Updates
Create & Edit forms include a Category dropdown

Category is required when creating/updating a product

Category name is displayed in the Products list table

 Form Validation
Validation is handled using Laravel Form Requests:

StoreProductRequest & UpdateProductRequest
name: required, unique

price: required, numeric, greater than 0

category_id: required, must exist in categories table

 Query Optimization
Used Eager Loading to avoid N+1 problem:

Product::with('category')->get();


 Database Structure
categories table
Column	Type
id	bigint
name	string (unique)
created_at	timestamp
updated_at	timestamp

products table
Column	Type
id	bigint
name	string
price	decimal(8,2)
category_id	foreign key
created_at	timestamp
updated_at	timestamp

 How to Run the Project
 Install dependencies

composer install
 Configure environment
Copy .env.example to .env

Update database credentials

Generate app key

php artisan key:generate

Run migrations & seeders
php artisan migrate:fresh --seed

 Start the server

php artisan serve

Open:

http://127.0.0.1:8000/products


 Expected Outcome
Categories and Products are linked via One-to-Many relationship

Products always belong to a valid category

CRUD operations work correctly

Clean UI with category display

Optimized queries using Eager Loading

 Notes
This task focuses on data integrity, clean architecture, and Laravel best practices

Suitable for learning Eloquent Relationships and real-world CRUD design

👤 Author
MAHMOOD MADY
Laravel Training – Task 05
