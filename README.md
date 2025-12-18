# FXFLARE - AI-Powered Market Intelligence

![FXFLARE](https://via.placeholder.com/800x200?text=FXFLARE+Banner) <!-- Boleh diganti dengan banner asli jika ada -->

**Modern Financial News Aggregator Platform** tailored for traders and investors. We provide real-time news, AI-driven sentiment analysis, and smart summaries to give you the edge in the market.

---

## 👥 Project Team (5 Members)

| Role | Responsibility |
| :--- | :--- |
| **Project Manager (PM)** | Project restructuring, Requirement gathering, Coordination. |
| **Backend Dev 1** | Database Design (Migrations), Models, API Integration. |
| **Backend Dev 2** | Authentication, CRUD Logic (Dashboard), Image Handling. |
| **Frontend Dev 1** | Implement Dashboard Views, Integrate real data into UI. |
| **Frontend Dev 2** | Polish Landing Page, Responsive Design, PDF Reporting UI. |

---

## 🚀 Project Status

### ✅ Completed (What has been done)
*   **Structure Refactoring**: Codebase organized into `Auth`, `Dashboard` (Planned), and `Public` segments.
    *   `resources/views/auth/` (Login & Register moved here).
    *   `resources/views/components/` (Modular UI components like Hero, Carousel, Marquee).
*   **Frontend Foundation**:
    *   **Landing Page**: Implemented with Dark Mode, Tailwind CSS, and Alpine.js.
    *   **Asset Management**: Migrated from CDN to **Vite** (`@vite(['resources/css/app.css', 'resources/js/app.js'])`).
    *   **Components**: Hero (Search), Marquee (Live Prices), Carousel (News), Sentiment Analysis UI.

### 📝 To-Do List (What needs to be done)

#### **Backend Team**
1.  **Database & Relational Models**:
    *   Create migrations for `users`, `articles`, `categories`, `market_data`, etc. (Must have >1 relation).
2.  **Dashboard Controller**:
    *   Create `DashboardController` and implement Admin logic.
3.  **CRUD Operations**:
    *   Create, Read, Update, Delete for Articles/News.
    *   Implement **Live Search** and **Filters**.
4.  **Image Management**:
    *   Upload/Delete logic with validation (MIME types, size).
5.  **API Integration**:
    *   Connect to external Open APIs (e.g., NewsAPI, AlphaVantage) for real market data.
6.  **PDF Reporting**:
    *   Generate reports for market summaries.

#### **Frontend Team**
1.  **Dashboard UI**:
    *   Create `resources/views/dashboard/index.blade.php`.
    *   Implement forms for CRUD (Create Article, Edit User, etc.).
2.  **Auth Integration**:
    *   Connect Login/Register forms to POST routes.
3.  **Dynamic Data**:
    *   Replace hardcoded HTML in `home.blade.php` with dynamic Blade loops (`@foreach $articles as $article`).

---

## 📂 Folder Structure Guide

We strictly separate concerns. Please follow this structure:

```
fxflare/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/           <-- AuthController (Login/Register logic)
│   │   ├── Admin/          <-- DashboardController (Admin CRUD)
│   │   └── HomeController.php
├── resources/
│   ├── views/
│   │   ├── auth/           <-- login.blade.php, register.blade.php
│   │   ├── dashboard/      <-- Admin views (index, create, edit)
│   │   ├── components/     <-- Reusable UI (navbar, hero, cards)
│   │   ├── home.blade.php  <-- Main Landing Page
│   │   └── components/layout.blade.php  <-- Main Layout (DO NOT use CDN, use Vite)
```

---

## 🛠 Tech Stack

*   **Framework**: Laravel 12
*   **Styling**: Tailwind CSS v4 (via Vite)
*   **Interactivity**: Alpine.js
*   **Asset Bundler**: Vite (Run `npm run dev` locally)
*   **Auth**: Custom (or Starter Kit modified to fit structure)

## ⚡ Getting Started

1.  **Clone Repo**: `git clone ...`
2.  **Install PHP Deps**: `composer install`
3.  **Install JS Deps**: `npm install`
4.  **Setup Env**: `cp .env.example .env` and configure DB.
5.  **Run Development**:
    *   Terminal 1: `composer run dev` (starts Laravel server)
    *   Terminal 2: `npm run dev` (starts Vite hot-reload)

---

**Note for Team**: Please respect the folder structure. Do not put everything in the root `views` folder. Use Controllers for logic, do not put logic in Routes closure.
