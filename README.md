# 📘 Task 06: Many-to-Many Relationship (Products ↔ Suppliers)

## 📌 Objective | الهدف

Enhance the existing **Products & Categories** system by implementing a

**Many-to-Many relationship** between **Products** and **Suppliers** using a  **Pivot Table** .

👉 الهدف من هذه المهمة هو تطبيق علاقة **متعدد إلى متعدد** مع تخزين بيانات إضافية داخل جدول وسيط.

---

## 🧱 Database Structure | هيكل قاعدة البيانات

### 1️⃣ Suppliers Table

تم إنشاء جدول `suppliers` ويحتوي على:

* `id`
* `name` (unique)
* `email` (unique)
* `timestamps`

📌 تم إضافة **5 موردين** باستخدام Seeder.

---

### 2️⃣ Pivot Table: `product_supplier`

هذا الجدول يربط بين المنتجات والموردين.

الحقول:

* `product_id` → مرتبط بجدول المنتجات
* `supplier_id` → مرتبط بجدول الموردين
* `cost_price` → سعر التوريد
* `lead_time_days` → مدة التوريد بالأيام
* `timestamps`

⚠️ تم إضافة:

* Foreign Keys
* Cascade On Delete
* Unique Constraint لمنع التكرار

---

## 🔗 Eloquent Relationships

### Product Model

<pre class="overflow-visible! px-0!" data-start="1105" data-end="1278"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-php"><span><span>public</span><span></span><span>function</span><span></span><span>suppliers</span><span>(</span><span></span><span>)
{
    </span><span>return</span><span></span><span>$this</span><span>-></span><span>belongsToMany</span><span>(</span><span>Supplier</span><span>::</span><span>class</span><span>)
        -></span><span>withPivot</span><span>([</span><span>'cost_price'</span><span>, </span><span>'lead_time_days'</span><span>])
        -></span><span>withTimestamps</span><span>();
}
</span></span></code></div></div></pre>

### Supplier Model

<pre class="overflow-visible! px-0!" data-start="1299" data-end="1470"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-php"><span><span>public</span><span></span><span>function</span><span></span><span>products</span><span>(</span><span></span><span>)
{
    </span><span>return</span><span></span><span>$this</span><span>-></span><span>belongsToMany</span><span>(</span><span>Product</span><span>::</span><span>class</span><span>)
        -></span><span>withPivot</span><span>([</span><span>'cost_price'</span><span>, </span><span>'lead_time_days'</span><span>])
        -></span><span>withTimestamps</span><span>();
}
</span></span></code></div></div></pre>

📌 بهذه الطريقة يمكن لكل منتج أن يكون له أكثر من مورد والعكس صحيح.

---

## 🌱 Seeders | تعبئة البيانات

تم إنشاء Seeders التالية:

* CategorySeeder
* ProductSeeder
* SupplierSeeder
* ProductSupplierSeeder

📌 كل منتج مرتبط بـ **1–3 موردين** مع بيانات Pivot كاملة.

---

## 📝 Forms (Create / Edit Product)

تم تعديل صفحات:

* `products.create`
* `products.edit`

لإضافة قسم **Suppliers**

### Structure المعتمد

<pre class="overflow-visible! px-0!" data-start="1882" data-end="2000"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-text"><span><span>suppliers[SUPPLIER_ID][selected]
suppliers[SUPPLIER_ID][cost_price]
suppliers[SUPPLIER_ID][lead_time_days]
</span></span></code></div></div></pre>

✔ هذا الشكل يسهل:

* التحقق من البيانات (Validation)
* حفظ العلاقات في Pivot Table

---

## ⚙️ Controller Logic

### Store

* حفظ المنتج
* ربط الموردين باستخدام `sync()` مع بيانات Pivot

### Update

* تحديث المنتج
* تحديث الموردين بدون حذفهم عند عدم التعديل عليهم

📌 تم التعامل مع:

* الإضافة
* الحذف
* التحديث

---

## ✅ Validation | التحقق من البيانات

تم تطبيق Validation على:

* اختيار مورد واحد على الأقل
* التأكد من وجود المورد في قاعدة البيانات
* التحقق من:
  * cost_price ≥ 0
  * lead_time_days ≥ 0

---

## 👀 Displaying Data | عرض البيانات

### Products Index

* عرض الموردين لكل منتج مع بيانات Pivot
* عرض عدد الموردين لكل منتج

مثال:

<pre class="overflow-visible! px-0!" data-start="2643" data-end="2690"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre!"><span><span>Supplier</span><span></span><span>A</span><span> (</span><span>cost</span><span>: </span><span>120.50</span><span>, </span><span>lead</span><span>: </span><span>7</span><span> days)
</span></span></code></div></div></pre>

---

## 🚀 Bonus: Eager Loading

لتجنب مشكلة N+1 Query:

<pre class="overflow-visible! px-0!" data-start="2748" data-end="2853"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-php"><span><span>$products</span><span> = </span><span>Product</span><span>::</span><span>with</span><span>([</span><span>'category'</span><span>, </span><span>'suppliers'</span><span>])
    -></span><span>withCount</span><span>(</span><span>'suppliers'</span><span>)
    -></span><span>get</span><span>();
</span></span></code></div></div></pre>

---

## ▶️ How to Run | طريقة التشغيل

<pre class="overflow-visible! px-0!" data-start="2894" data-end="2973"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre! language-bash"><span><span>composer install
php artisan migrate:fresh --seed
php artisan serve
</span></span></code></div></div></pre>

ثم زيارة:

<pre class="overflow-visible! px-0!" data-start="2985" data-end="3014"><div class="contain-inline-size rounded-2xl corner-superellipse/1.1 relative bg-token-sidebar-surface-primary"><div class="sticky top-[calc(--spacing(9)+var(--header-height))] @w-xl/main:top-9"><div class="absolute end-0 bottom-0 flex h-9 items-center pe-2"><div class="bg-token-bg-elevated-secondary text-token-text-secondary flex items-center gap-4 rounded-sm px-2 font-sans text-xs"></div></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="whitespace-pre!"><span><span>http:</span><span>//127.0.0.1:8000</span><span>
</span></span></code></div></div></pre>

---

## ✅ Final Result | النتيجة النهائية

✔ تطبيق علاقة Many-to-Many بنجاح

✔ تخزين بيانات Pivot بشكل صحيح

✔ التحكم بالموردين من الواجهة

✔ استخدام Eager Loading

✔ كود منظم ومتوافق مع Laravel Standards

###### 👤 Author

~~MAHMOOD MADY~~

Laravel Training – Task 6

🎯 **Task 06 Completed Successfully**
