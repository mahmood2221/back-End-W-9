# Laravel Basic Database Operations – Products Example

هذا المشروع يوضح كيفية إنشاء نموذج (Model) وهجرة (Migration) وSeeder في Laravel لإدارة المنتجات داخل قاعدة البيانات.

---

## 🚀 المتطلبات
- PHP 8.1+
- Composer
- Laravel 10+
- MySQL أو أي قاعدة بيانات مدعومة

---

## 📌 خطوات تثبيت المشروع

### 1. استنساخ المشروع
```bash
git clone <repository-url>
cd project-folder
```

### 2. تثبيت الاعتمادات
```bash
composer install
```

### 3. إعداد ملف البيئة
انسخ الملف:
```bash
cp .env.example .env
```
ثم عدّل إعدادات قاعدة البيانات:
```
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=
```

### 4. إنشاء مفتاح التطبيق
```bash
php artisan key:generate
```

### 🛠️ تشغيل الهجرة (Migration)
```bash
php artisan migrate
```

### 🌱 تشغيل Seeder لإضافة البيانات التجريبية
```bash
php artisan db:seed
```

أو تشغيل Seeder معين:
```bash
php artisan db:seed --class=ProductSeeder
```

### 🔍 التحقق من البيانات باستخدام Tinker
```bash
php artisan tinker
App\Models\Product::all();
```

---

## 📝 ملاحظات
- تم استخدام `$fillable` للحماية من **Mass Assignment**.
- لا تنسَ تشغيل الهجرة قبل Seeder.
- يمكن تطوير نموذج Product لاحقاً لإضافة فئات أو علاقات.

