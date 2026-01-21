
# 🛡️ Task 07: Authentication & Authorization (Products ↔ Users Ownership)

## 🎯 الأهداف (Objective)

تطوير نظام إدارة المنتجات والفئات من خلال دمج نظام الهوية والصلاحيات، وربط كل منتج بمستخدم معين (مالك) وتقييد العمليات الحساسة للملاك فقط.

---

## ✅ المتطلبات التقنية المنجزة مع الأكواد (Implementation)

### 1. نظام الهوية (Laravel Breeze)

تم تنصيب حزمة **Laravel Breeze** لتوفير ميزات (Register, Login, Logout).

* **الأمر المستخدم:** `php artisan breeze:install blade`

### 2. ملكية المنتج (Database Migration)

إضافة حقل `user_id` لربط المنتجات بالمستخدمين.

* **كود الـ Migration:**

**PHP**

```
Schema::table('products', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
});
```

### 3. علاقات Eloquent (Models)

تعريف العلاقات في الموديلات لتمكين استدعاء البيانات بسهولة.

* **في الموديل `User.php`:**

**PHP**

```
public function products() {
    return $this->hasMany(Product::class);
}
```

* **في الموديل `Product.php`:**

**PHP**

```
public function user() {
    return $this->belongsTo(User::class);
}
```

### 4. التخزين التلقائي للمالك (Controller Logic)

تحديث دالة `store` لإسناد المنتج للمستخدم الحالي برمجياً دون الحاجة لحقل إدخال.

* **في الـ `ProductController.php`:**

**PHP**

```
public function store(Request $request) {
    $validated = $request->validate([...]);
  
    // إسناد المالك تلقائياً
    $request->user()->products()->create($validated);

    return redirect()->route('products.index');
}
```

### 5. سياسة الصلاحيات (ProductPolicy)

إنشاء سياسة لمنع التعديل والحذف لغير المالك.

* **كود السياسة في `app/Policies/ProductPolicy.php`:**

**PHP**

```
public function update(User $user, Product $product) {
    return $user->id === $product->user_id;
}

public function delete(User $user, Product $product) {
    return $user->id === $product->user_id;
}
```

### 6. حماية الواجهة (Blade Views)

إظهار أزرار التحكم للمالك فقط وعرض اسم المالك في الجدول.

* **في ملف `index.blade.php`:**

**Blade**

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

تمت إضافة اختبارات لضمان أمن النظام.

* **كود الاختبار في `tests/Feature/ProductAccessTest.php`:**

**PHP**

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

1. **تحديث قاعدة البيانات:**
   **Bash**

   ```
   php artisan migrate:fresh --seed
   ```
2. **تشغيل الاختبارات:**
   **Bash**

   ```
   php artisan test --filter=ProductAccessTest
   ```


**الدخول للمعاينة:**

* **User:** `test@example.com`
* **Pass:** `password`
