
# 📦 Inventory Management System - Task 09 (Pro Listing)

Welcome to the **Task 09** update. In this version, the Products Listing page has been upgraded into a production-style management dashboard with advanced data browsing capabilities.

## 🚀 Key Features in Task 09

### 1. Advanced Search 🔍

- Users can now search for products by **Name** instantly.
- The search is integrated with other filters to provide precise results.

### 2. Dynamic Filtering 🛠️

- **Category Filter:** Narrow down products by their assigned category.
- **Supplier Filter:** Since we have a Many-to-Many relationship, you can now filter products based on which supplier provides them (using `whereHas` logic).

### 3. Smart Sorting 📶

- Support for multiple sorting options:
  - **Newest → Oldest** (Default).
  - **Price:** Low to High / High to Low.
  - **Alphabetical:** A-Z for product names.
- Implemented using a **Whitelist** approach to ensure security and prevent SQL injection.

### 4. Query Persistence & Pagination 📄

- **Pagination:** Results are limited to 10 products per page for better performance.
- **withQueryString():** Search terms, filters, and sorting options are preserved when navigating between pages.

### 5. Enhanced UI/UX 🎨

- **Top Toolbar:** A clean form for searching and filtering.
- **Empty State:** A clear "No products found" message appears when criteria don't match any results.
- **Reset Functionality:** Quickly clear all filters with one click.

## 🛠️ Technical Implementation

- **Controller:** Optimized `index` method using Laravel Query Builder.
- **Eloquent:** Used `with()` for Eager Loading to solve the N+1 problem.
- **Blade:** Used `@forelse` for efficient empty state handling.

---

![1769689203640](image/README/1769689203640.png)
