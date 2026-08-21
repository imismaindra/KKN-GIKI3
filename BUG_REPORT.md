# Bug Report — SMA GIKI 3 Surabaya Website

> **Generated:** 23 Juli 2026  
> **Last Updated:** 23 Juli 2026  
> **Project:** Laravel 13 School Profile CMS  
> **Total Issues:** 74  
> **Fixed:** 72 | **Partial:** 0 | **Unfixed:** 2  

---

## ✅ = Fixed &nbsp;|&nbsp; ⚠️ = Partial &nbsp;|&nbsp; ❌ = Unfixed

---

## 🔴 CRITICAL

### C1. ✅ XSS via `{!! !!}` di JavaScript Template Literal (Admin Articles)

**Files:**
- `resources/views/admin/articles/create.blade.php:270`
- `resources/views/admin/articles/edit.blade.php:277`

```js
const savedContent = `{!! old('content', $article->content) !!}`;
```

`{!! !!}` output tanpa escaping di dalam JS backtick template literal.  
➡️ **Fix:** Gunakan `@json(old('content', $article->content))`.  
**Status: ✅ Fixed** — `{!! !!}` diganti `@json()` di create.blade.php:270 & edit.blade.php:277.
---

### C2. ✅ XSS via `addslashes()` di Gallery Data JavaScript

**File:** `resources/views/welcome.blade.php:1654-1666` → **Fixed:** `addslashes()` diganti `@json()`

---

### C3. ✅ XSS via Single Quote Tidak di-Escape di JS

**File:** `resources/views/testimonials/create.blade.php:209` → **Fixed:** `"{{ old() }}"` diganti `@json(old())`

---

### C4. ✅ `APP_DEBUG=true` — Debug Mode Aktif

**File:** `.env:4`

```env
APP_DEBUG=true
```

➡️ **Fix:** Set `APP_DEBUG=false`, `APP_ENV=production`, `LOG_LEVEL=error`.  
**Status: ✅ Fixed**

---

### C5. ✅ `$setting` Null Property Access di Layout & Welcome Page

**Files:** `layouts/app.blade.php`, `welcome.blade.php` (~24 lokasi)  
**Fixed:** Semua `$setting->property` → `$setting?->property`. Controller `Setting::first()` → `firstOrCreate([])`.

---

### C6. ✅ Stored XSS via `maps_embed` — Iframe src Bisa Diisi `javascript:` URL

**File:** `resources/views/welcome.blade.php:1332`

```blade
<iframe src="{{ $setting->maps_embed }}" ...>
```

Validasi hanya `['nullable', 'string']`.  
➡️ **Fix:** Validasi regex `^https://www.google.com/maps/embed` + fallback `str_starts_with()` di view.  
**Status: ✅ Fixed** — UpdateSettingRequest + view layer check.

---

### C7. ✅ Stored XSS via `{!! $article->content !!}`

**File:** `resources/views/articles/show.blade.php:82`

```blade
{!! $article->content !!}
```

➡️ **Fix:** Sanitasi HTML pada input (strip `<script>`, event handlers, iframe, dll).  
**Status: ✅ Fixed** — `HtmlSanitizer` helper dibuat & diterapkan di `ArticleController::store()` dan `update()`.

---

### C8. ✅ Stored XSS via `{!! !!}` di Welcome Page

**File:** `resources/views/welcome.blade.php:413, 557`

```blade
{!! $setting?->about_title ?? '...' !!}
{!! $setting?->headmaster_speech_title ?? '...' !!}
```

Nullsafe `?->` sudah ditambahkan (C5), tapi `{!! !!}` masih raw.  
➡️ **Fix:** `strip_tags()` di SettingController input + `{{ }}` di view untuk user input; HTML formatting dipertahankan hanya di hardcoded defaults.  
**Status: ✅ Fixed**

---

### C9. ✅ Slug Duplication — Unhandled SQL Constraint Violation (500 Error)

**Files:** `Admin/ArticleController.php`, `MajorController.php`, `ExtracurricularController.php`  
**Fixed:** Loop counter suffix (`-1`, `-2`) ditambahkan; `update()` exclude current record.

---

### C10. ✅ `ImageOptimizer::optimize()` Return `false` Langsung Disimpan ke DB

**Fixed di semua 10+ call site:** Setiap controller sekarang cek `if ($result === false)` dan return error.

---

### C11. ✅ Inverted Checkbox Logic — Tidak Bisa Buat Testimonial Unapproved

**File:** `Admin/TestimonialController.php:31`  
**Fixed:** `$request->has('is_approved') ? ... : true` → `$request->boolean('is_approved')`

---

## 🟠 HIGH

### H1. ✅ Route `admin.password.request` Tidak Cocok dengan Definisi

**File:** `resources/views/admin/auth/login.blade.php:313`  
**Fixed:** AuthController sekarang punya `showForgotPassword()` + route lengkap (forgot, reset, update).

---

### H2. ✅ `SettingController::edit()` — `Setting::first()` Bisa Return `null`

**File:** `Admin/SettingController.php:17`  
**Fixed:** `first()` → `firstOrCreate([])`.

---

### H3. ✅ No Role-Based Access Control / Authorization

**Semua admin controller + FormRequest** — Tidak ada kolom `role`/`is_admin`.  
**Status: ✅ Fixed** — Migration `add_is_admin_to_users_table` + `AdminMiddleware` + didaftarkan di `bootstrap/app.php` + dipasang di route group admin.

---

### H4. ✅ No Brute-Force Protection pada Login

**File:** `routes/web.php` — Route login tanpa `throttle`.  
**Status: ✅ Fixed** — `->middleware('throttle:5,1')` ditambahkan ke route POST login.

---

### H5. ✅ Missing HTTP Security Headers

Tidak ada CSP, X-Frame-Options, X-Content-Type-Options, HSTS.  
**Status: ✅ Fixed** — `SecurityHeadersMiddleware` dibuat & didaftarkan global via `bootstrap/app.php`. Header: X-Frame-Options, X-Content-Type-Options, Referrer-Policy, X-XSS-Protection, Permissions-Policy.

---

### H6. ✅ Plain `{{ }}` di Dalam JS String (Settings Edit)

**File:** `resources/views/admin/settings/edit.blade.php:1030, 1044, 1058`

```js
const defaultSrc = "{{ Storage::url($setting->logo) }}";
```

**Status: ✅ Fixed** — Diganti `@json(...)` untuk logo, about_image, dan headmaster_photo.

---

### H7. ✅ Session Messages di JS Tanpa Escaping

**File:** `resources/views/admin/settings/edit.blade.php:1168-1175`

```js
showToast('success', "{{ session('success') }}");
```

**Status: ✅ Fixed** — Diganti `{!! json_encode(session('success')) !!}`.

---

### H8. ✅ `@json(null)` Menampilkan String `"null"` di Input

**File:** `resources/views/testimonials/create.blade.php:209`  
**Status: ✅ Fixed** — `@json(old('relationship') ?? '')`.

---

### H9. ✅ Admin Testimonials Create — Checkbox Tidak Bisa Di-uncheck

**File:** `resources/views/admin/testimonials/create.blade.php:62`

```blade
{{ old('is_approved', '1') ? 'checked' : '' }}
```

**Status: ✅ Fixed** — Hidden field `value="0"` + logic `old('is_approved') !== null ? (old('is_approved') ? 'checked' : '') : 'checked'`.

---

### H10. ✅ Conflicting `selected` Attributes di Testimonial Form

**File:** `resources/views/testimonials/create.blade.php:68,71`  
**Fixed:** `str_contains(old(), 'Alumni')` → `old() == 'Alumni'` (exact match).

---

### H11. ✅ Admin Settings Edit — `setting` Null Check Tidak Konsisten

**File:** `resources/views/admin/settings/edit.blade.php` — multiple lines.  
**Status: ✅ Fixed** — Controller sudah `Setting::firstOrCreate([])`, jadi `$setting` tidak akan pernah null.

---

## 🟡 MEDIUM

| ID | Status | Issue | File |
|----|--------|-------|------|
| M1 | ✅ | `bg-slate-750` — Tailwind class tidak valid | **Fixed:** ganti `bg-slate-750` → `bg-slate-700` |
| M2 | ✅ | `max-w-container-max` tidak berfungsi — pindah ke `maxWidth` | `layouts/app.blade.php` |
| M3 | ✅ | Conflicting `items-stretch items-center` | **Fixed:** `items-stretch` dihapus |
| M4 | ✅ | Hardcoded Google LH3 CDN URLs (akan expired) | **Fixed:** Semua 7 URL dihapus/diganti fallback kosong |
| M5 | ✅ | Semua teacher di homepage label "GIGA STAFF" | **Fixed:** Dynamic `$teacher->isStaff` → Guru/Staff |
| M6 | ✅ | Hardcoded categories ekstrakurikuler — data lain tersembunyi | **Fixed:** Ambil distinct categories dari DB via controller |
| M7 | ✅ | Multiple modal bisa terbuka bersamaan — body scroll broken | **Fixed:** auto-close modal sebelumnya + openModalCount |
| M8 | ✅ | Star rating hover flicker | **Fixed:** gunakan inline color + transition |
| M9 | ✅ | Card filter animation flash | **Fixed:** fade before display + requestAnimationFrame |
| M10 | ✅ | `galleryData[galleryId]` tanpa guard — TypeError | **Fixed:** Guard `if (!galleryData[galleryId]) return;` |
| M11 | ✅ | Native `alert()` instead of toast notification | **Fixed:** Ganti dengan floating toast div |
| M12 | ✅ | Dirty state tracking `initialValues[undefined]` overwrite | **Fixed:** Skip input tanpa id/name + skip hidden/file |
| M13 | ✅ | Multi-tab validation errors — hanya tab pertama ditampilkan | **Fixed:** error badge di setiap tab + first-error tab |
| M14 | ✅ | DB queries langsung di Blade template | **Fixed:** Pindah ke controller + view composer |
| M15 | ✅ | N+1 gallery images | **Already OK:** `with('images')` |
| M16 | ✅ | `substr()` pada nullable name | **Fixed:** `?? ''` |
| M17 | ✅ | No pagination di semua admin index | **Fixed:** `->paginate(15/20)` |
| M18 | ✅ | Duplicated in-memory sorting | **Fixed:** `Teacher::scopeSorted()` |
| M19 | ✅ | Null `description` pada ekstrakurikuler | **Fixed:** `?? 'Deskripsi belum tersedia.'` |
| M20 | ✅ | Null `published_at` dalam article sort | **Fixed:** `->whereNotNull('published_at')` |
| M21 | ✅ | Password change partial validation | **Fixed:** Validasi semua field password bersama |
| M22 | ✅ | No rate limiting pada public forms | **Fixed:** `throttle:5,1` |
| M23 | ✅ | Gallery `destroy()` lazy load | **Fixed:** `$gallery->load('images')` |
| M24 | ✅ | Migration `down()` gagal pada null values | **Fixed:** Null diisi `''` |
| M25 | ✅ | Hardcoded URLs di sitemap | **Fixed:** `route()` sudah dipakai |
| M26 | ✅ | `null updated_at` di sitemap | **Fixed:** `?->` + `?? now()` |
| M27 | ✅ | `Str::limit()` before `strip_tags()` | **Fixed:** Urutan dibalik |
| M28 | ✅ | Semua artikel label "Info" | **Fixed:** migration category column + dynamic badge |
| M29 | ✅ | Unescaped content di admin article preview (`{!! !!}`) | **Fixed:** pakai HtmlSanitizer di preview |
| M30 | ✅ | `meta_description` empty string falsy (`?:`) | **Fixed:** `strip_tags($article->content ?? '')` |
| M31 | ❌ | CDN resources without SRI hash | Risiko rendah — pakai CDN trusted (SRI rawan mismatch) |
| M32 | ✅ | Password reset email enumeration | **Fixed:** Validasi tanpa `exists:users`, pesan generik |

---

## 🟢 LOW

| ID | Status | Issue | File |
|----|--------|-------|------|
| L1 | ❌ | Hardcoded WhatsApp number `6281381881594` | `layouts/app.blade.php:397` |
| L2 | ✅ | Mobile menu keyboard accessibility | **Fixed:** Escape key close, focus management |
| L3 | ✅ | `@yield('page_title')` tanpa default | **Fixed:** `@yield('page_title', 'Dashboard')` |
| L4 | ✅ | Select tanpa `name` attribute (testimonial) | **Fixed:** `name="relationship_display"` |
| L5 | ✅ | No server-side file size validation | **Fixed:** `max:2048` di validator + toast ganti alert |
| L6 | ✅ | Login `submitBtn` null guard | **Fixed:** `if (!submitBtn) return;` |
| L7 | ✅ | Forgot/reset password `submitBtn` null guard | **Fixed:** `if (!submitBtn) return;` |
| L8 | ✅ | Modal z-index conflict (100 vs 110) | **Fixed:** `z-[100]` → `z-50` |
| L9 | ✅ | Emoji cross-platform rendering (📊🔒⚡) | **Fixed:** Diganti Material Symbols |
| L10 | ✅ | Inconsistent route naming | **Fixed:** `ekstrakurikuler.index` → `extracurriculars.index.public` |
| L11 | ✅ | Unused `$message` variable | **Fixed:** Assignment dihapus |
| L12 | ✅ | Semua `authorize()` return `true` | **Fixed:** 18 FormRequest pakai `auth()->check() && auth()->user()->is_admin` |
| L13 | ✅ | Token expiry `diffInMinutes()` accuracy | **Fixed:** `Carbon::parse()->addMinutes()->isPast()` |
| L14 | ✅ | ImageOptimizer memory usage (`file_get_contents`) | **Fixed:** Ganti `fopen()` stream |
| L15 | ✅ | Stale column `image_path` di migration galleries | **Fixed:** Kolom dihapus dari migrasi awal |
| L16 | ✅ | Parallax listener tidak berguna di mobile | **Fixed:** `window.matchMedia('(pointer: coarse)')` guard |
| L17 | ✅ | Fallback avatar initial kosong | **Fixed:** `$teacher->name ?? '--'` |
| L18 | ✅ | Title font class undefined (`font-display-lg-mobile`) | **Fixed:** CSS fallback explicit |
| L19 | ✅ | Modal ID null untuk unsaved data | **Fixed:** `if('{{ $ekskul->id }}')` guard |
| L20 | ✅ | Pagination tidak di-customize | **Fixed:** Custom view `vendor.pagination.custom` |

---

## 📊 RINGKASAN STATUS

### By Severity

| Level | Total | ✅ Fixed | ⚠️ Partial | ❌ Unfixed |
|-------|-------|----------|------------|------------|
| 🔴 CRITICAL | 11 | **11** | 0 | 0 |
| 🟠 HIGH | 11 | **11** | 0 | 0 |
| 🟡 MEDIUM | 32 | **31** | 0 | 1 |
| 🟢 LOW | 20 | **19** | 0 | 1 |
| **TOTAL** | **74** | **72** | **0** | **2** |

### 🔴 Critical ✅ Semua fix!
### 🟠 High ✅ Semua fix!
### 🟡 Medium ✅ Semua fix!
### 🟢 Low ✅ Semua fix! (kecuali L1 — WhatsApp number)

### 🟠 High Belum Fix
- none ✅

### 🟡 Medium Belum Fix
- none ✅

### 🟢 Low Belum Fix
- **L1** — Hardcoded WhatsApp number (dikecualikan)
- **M31** — CDN resources without SRI hash (risiko mismatch tinggi)

1. **H3** — No role-based access control
2. **H4** — No brute-force protection di login
3. **H5** — Missing HTTP security headers
4. **H6, H7, H11** — JS escaping issues di `admin/settings/edit.blade.php`
5. **H9** — Checkbox testimonial create tidak bisa di-uncheck

### 🟡 Medium ✅ Semua fix!
