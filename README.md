
# 🛡️ Task 07: Authentication & Authorization (Products ↔ Users Ownership)

[](https://github.com/mahmood2221/back-End-W-70#%EF%B8%8F-task-07-authentication--authorization-products--users-ownership)

## 🎯 الأهداف (Objective)

[](https://github.com/mahmood2221/back-End-W-70#-%D8%A7%D9%84%D8%A3%D9%87%D8%AF%D8%A7%D9%81-objective)

تطوير نظام إدارة المنتجات والفئات من خلال دمج نظام الهوية والصلاحيات، وربط كل منتج بمستخدم معين (مالك) وتقييد العمليات الحساسة للملاك فقط.

---

## ✅ المتطلبات التقنية المنجزة مع الأكواد (Implementation)

[](https://github.com/mahmood2221/back-End-W-70#-%D8%A7%D9%84%D9%85%D8%AA%D8%B7%D9%84%D8%A8%D8%A7%D8%AA-%D8%A7%D9%84%D8%AA%D9%82%D9%86%D9%8A%D8%A9-%D8%A7%D9%84%D9%85%D9%86%D8%AC%D8%B2%D8%A9-%D9%85%D8%B9-%D8%A7%D9%84%D8%A3%D9%83%D9%88%D8%A7%D8%AF-implementation)

### 1. نظام الهوية (Laravel Breeze)

[](https://github.com/mahmood2221/back-End-W-70#1-%D9%86%D8%B8%D8%A7%D9%85-%D8%A7%D9%84%D9%87%D9%88%D9%8A%D8%A9-laravel-breeze)

تم تنصيب حزمة **Laravel Breeze** لتوفير ميزات (Register, Login, Logout).

* **الأمر المستخدم:** `php artisan breeze:install blade`

### 2. ملكية المنتج (Database Migration)

[](https://github.com/mahmood2221/back-End-W-70#2-%D9%85%D9%84%D9%83%D9%8A%D8%A9-%D8%A7%D9%84%D9%85%D9%86%D8%AA%D8%AC-database-migration)

إضافة حقل `user_id` لربط المنتجات بالمستخدمين.

* **كود الـ Migration:**

**PHP**

Copy to BlackBox

```
Schema::table('products', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
});
```

### 3. علاقات Eloquent (Models)

[](https://github.com/mahmood2221/back-End-W-70#3-%D8%B9%D9%84%D8%A7%D9%82%D8%A7%D8%AA-eloquent-models)

تعريف العلاقات في الموديلات لتمكين استدعاء البيانات بسهولة.

* **في الموديل `User.php`:**

**PHP**

Copy to BlackBox

```
public function products() {
    return $this->hasMany(Product::class);
}
```

* **في الموديل `Product.php`:**

**PHP**

Copy to BlackBox

```
public function user() {
    return $this->belongsTo(User::class);
}
```

### 4. التخزين التلقائي للمالك (Controller Logic)

[](https://github.com/mahmood2221/back-End-W-70#4-%D8%A7%D9%84%D8%AA%D8%AE%D8%B2%D9%8A%D9%86-%D8%A7%D9%84%D8%AA%D9%84%D9%82%D8%A7%D8%A6%D9%8A-%D9%84%D9%84%D9%85%D8%A7%D9%84%D9%83-controller-logic)

تحديث دالة `store` لإسناد المنتج للمستخدم الحالي برمجياً دون الحاجة لحقل إدخال.

* **في الـ `ProductController.php`:**

**PHP**

Copy to BlackBox

```
public function store(Request $request) {
    $validated = $request->validate([...]);
  
    // إسناد المالك تلقائياً
    $request->user()->products()->create($validated);

    return redirect()->route('products.index');
}
```

### 5. سياسة الصلاحيات (ProductPolicy)

[](https://github.com/mahmood2221/back-End-W-70#5-%D8%B3%D9%8A%D8%A7%D8%B3%D8%A9-%D8%A7%D9%84%D8%B5%D9%84%D8%A7%D8%AD%D9%8A%D8%A7%D8%AA-productpolicy)

إنشاء سياسة لمنع التعديل والحذف لغير المالك.

* **كود السياسة في `app/Policies/ProductPolicy.php`:**

**PHP**

Copy to BlackBox

```
public function update(User $user, Product $product) {
    return $user->id === $product->user_id;
}

public function delete(User $user, Product $product) {
    return $user->id === $product->user_id;
}
```

### 6. حماية الواجهة (Blade Views)

[](https://github.com/mahmood2221/back-End-W-70#6-%D8%AD%D9%85%D8%A7%D9%8A%D8%A9-%D8%A7%D9%84%D9%88%D8%A7%D8%AC%D9%87%D8%A9-blade-views)

إظهار أزرار التحكم للمالك فقط وعرض اسم المالك في الجدول.

* **في ملف `index.blade.php`:**

**Blade**

Copy to BlackBox

```
<td>{{ $product->user->name }}</td>

@can('update', $product)
    <a href="{{ route('products.edit', $product) }}">Edit</a>
@endcan

@can('delete', $product)
    <form action="{{ route('products.destroy', $product) }}" method="POST">
        @csrf @method('DELETE')
        <button>Delete</button>
    </form>
@endcan
```

---

## 🧪 الاختبارات الآلية (Feature Tests)

[](https://github.com/mahmood2221/back-End-W-70#-%D8%A7%D9%84%D8%A7%D8%AE%D8%AA%D8%A8%D8%A7%D8%B1%D8%A7%D8%AA-%D8%A7%D9%84%D8%A2%D9%84%D9%8A%D8%A9-feature-tests)

تمت إضافة اختبارات لضمان أمن النظام.

* **كود الاختبار في `tests/Feature/ProductAccessTest.php`:**

**PHP**

Copy to BlackBox

```
public function test_user_cannot_edit_others_product() {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $product = Product::factory()->create(['user_id' => $user1->id]);

    // مستخدم 2 يحاول الدخول لمنتج مستخدم 1
    $response = $this->actingAs($user2)->get("/products/{$product->id}/edit");

    $response->assertStatus(403); // يجب أن يظهر 'محظور'
}
```

---

## 🚀 تعليمات التشغيل

[](https://github.com/mahmood2221/back-End-W-70#-%D8%AA%D8%B9%D9%84%D9%8A%D9%85%D8%A7%D8%AA-%D8%A7%D9%84%D8%AA%D8%B4%D8%BA%D9%8A%D9%84)

1. **تحديث قاعدة البيانات:** **Bash**
   Copy to BlackBox
   ```
   php artisan migrate:fresh --seed
   ```
2. **تشغيل الاختبارات:** **Bash**
   Copy to BlackBox
   ```
   php artisan test --filter=ProductAccessTest
   ```
