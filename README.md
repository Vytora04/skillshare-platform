# 🌍 SkillBridge for Social Impact

**SkillBridge for Social Impact** is a Laravel-based web platform that connects **volunteers, students, NGOs, and community projects** to exchange skills and collaborate on social-impact initiatives — inspired by **SDG 17: Partnerships for the Goals**.

The goal is to create a simple, searchable skill exchange system that helps smaller organizations access much-needed expertise without cost barriers.

---

## 🖼️ Demo Preview

> Homepage with TailwindCSS Hero, call-to-action buttons, and a skill post listing system.

---

## 🚀 Features Implemented

✅ **Home Page (Landing Section)**
- Hero with CTA buttons (Get Started, Explore, Browse Skill Posts)
- Responsive Tailwind design

✅ **Skill Post System**
- Model, Controller, Migration
- `/skill-posts` page showing “I Offer” and “I Need” listings
- Search functionality (by title, skills, or description)
- Detail page for each post

✅ **Seed Data**
- 2 sample posts (“UI/UX Designer for NGO Donation Page” and “Need Grant Writer…”)

✅ **Navigation Integration**
- Homepage and “Load More Projects” button link to `/skill-posts`

✅ **Auth Pages (Laravel Breeze)**
- Register & Login pages ready (basic flow)

---

## 🧩 Tech Stack

| Layer | Technology |
|-------|-------------|
| Frontend | Blade + TailwindCSS |
| Backend | Laravel 10 / PHP 8 |
| Database | MySQL / SQLite |
| Auth | Laravel Breeze |
| Hosting | Localhost / DigitalOcean |

---

## 🗂️ Folder Overview

```
resources/
 ├── views/
 │   ├── layouts/app.blade.php     → Main layout
 │   ├── projects/home.blade.php   → Homepage
 │   ├── skill_posts/              → Skill post views (index, show)
 │   └── auth/                     → Register/Login pages
 ├── routes/web.php                → Routes
 └── database/migrations/          → Tables (users, skill_posts)
```

---

## ⚙️ Installation & Setup

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/Vytora04/SkillBridge.git
cd SkillBridge
```

### 2️⃣ Install Dependencies
```bash
composer install
npm install && npm run dev
```

### 3️⃣ Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and update:
```
DB_CONNECTION=sqlite
# or
DB_CONNECTION=mysql
DB_DATABASE=skillbridge
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Run Migrations
```bash
php artisan migrate:fresh
```

### 5️⃣ (Optional) Seed Sample Data
Use Laravel Tinker:
```bash
php artisan tinker
use App\Models\SkillPost;

SkillPost::create([
    'title' => 'UI/UX Designer for NGO Donation Page',
    'type' => 'offer',
    'skills' => 'Figma, UX, UI Design',
    'location' => 'Remote',
    'time_commitment' => '5 hours over 1 week',
    'description' => 'I can help redesign your donation landing page to increase donor conversions.',
]);
```

### 6️⃣ Serve Locally
```bash
php artisan serve
```

Then open:  
👉 http://127.0.0.1:8000

---

## 🧭 Main Pages

| URL | Description |
|------|--------------|
| `/` | Homepage |
| `/skill-posts` | List of “I Offer” / “I Need” posts |
| `/skill-posts/{id}` | Post detail page |
| `/register` | Register new account |
| `/login` | Login page |

---

## 🧑‍💻 Future Improvements
- Add “Create Post” form (for Seekers and Providers)
- Add User Profiles and Roles
- Add Admin Dashboard
- Add Impact Showcase page

---

## 📸 Screenshots (add later)

| Page | Description |
|------|--------------|
| Homepage | Hero + CTA buttons |
| Skill Posts | Skill listing page |
| Detail | Post info card |

---

## 👥 Contributors

| Name | Role | Notes |
|------|------|-------|
| **Fahimsyach Lokanta** | Backend, Laravel setup | `lokantafahimsyach@gmail.com` |
| **Teammate Name** | Frontend (Blade + Tailwind) | |
| **Teammate Name** | Documentation / Testing | |

---

## 📄 License
This project is open-source under the [MIT License](https://opensource.org/licenses/MIT).

---

## ❤️ Acknowledgements
- Built using [Laravel](https://laravel.com)
- Styled with [TailwindCSS](https://tailwindcss.com)
- Inspired by real-world community volunteering and SDG 17 initiatives.

---
