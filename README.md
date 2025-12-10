# Laravel Basic Database Operations – Products Example

هذا المشروع يوضح كيفية إنشاء نموذج (Model) وهجرة (Migration) وSeeder في Laravel لإدارة المنتجات داخل قاعدة البيانات.

---

---

## **📌 Features**

* Product Model
* Migration with schema
* ProductSeeder with dummy data
* Database populated via seeders
* Example Tinker commands

### 2. تثبيت الاعتمادات

## **📁 Products Table Structure**

| Column     | Type         |
| ---------- | ------------ |
| id         | integer (PK) |
| name       | string       |
| price      | decimal      |
| created_at | timestamp    |
| updated_at | timestamp    |

```bash
composer install
```

### cp .env.example .env

## **🛠 Steps to Run the Project**

### **1. Install Dependencies**

<pre class="overflow-visible!" data-start="1231" data-end="1259"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-bash"><span><span>composer install</span></span></code></div></div></pre>

### **2. Configure Environment**

Copy `.env.example`:

<pre class="overflow-visible!" data-start="1321" data-end="1345"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-bash"><span><span>cp</span><span> .</span><span>env</span><span> .</span><span>env</span></span></code></div></div></pre>

Generate the app key:

<pre class="overflow-visible!" data-start="1370" data-end="1406"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-bash"><span><span>php artisan key:generate
</span></span></code></div></div></pre>

Update your database credentials inside `.env`:

DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

### **3. Run Migrations**

<pre class="overflow-visible!" data-start="1553" data-end="1584"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-bash"><span><span>php artisan migrate</span></span></code></div></div></pre>

<pre class="overflow-visible!" data-start="1457" data-end="1520"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"></div></div></pre>

### **4. Run Seeder**

<pre class="overflow-visible!" data-start="1613" data-end="1666"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-bash"><span><span>php artisan db:seed --class=ProductSeeder
</span></span></code></div></div></pre>

### **5. Verify Data**

Using Tinker:

<pre class="overflow-visible!" data-start="1711" data-end="1772"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-bash"><span><span>php artisan tinker
>>> App\Models\Product::all();
</span></span></code></div></div></pre>

Or check the database directly.


# ✅ **5. تشغيل المشروع**

### 1️⃣ شغّل السيرفر:

<pre class="overflow-visible!" data-start="5228" data-end="5253"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre!"><span><span>php</span><span> artisan serve
</span></span></code></div></div></pre>

### 2️⃣ افتح الصفحة:

<pre class="overflow-visible!" data-start="5276" data-end="5314"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre!"><span><span>http://localhost:8000/products
</span></span></code></div></div></pre>

ستظهر:

✔ عرض المنتجات

✔ إضافة منتج

✔ تعديل منتج

✔ حذف منتج

## **📌 Notes**

### ✔ Mass Assignment

The Product model includes:

<pre class="overflow-visible!" data-start="1880" data-end="1931"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-php"><span><span>protected</span><span></span><span>$fillable</span><span> = [</span><span>'name'</span><span>, </span><span>'price'</span><span>];</span></span></code></div></div></pre>

### ✔ Seeder Workflow

Migrations → Seeders

Always migrate before seeding.

### ✔ Tinker Testing

Useful to verify records after seeding.

## **📎 Repository Link**

(ضع هنا رابط GitHub الخاص بك)

Example:

`https://github.com/mahmood2221/back-End-W-3`
