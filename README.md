# FXFLARE - AI-Powered Market Intelligence

![FXFLARE](fxflare.png)

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

## 🚀 Project Status: **Active Development**

The project has reached a significant milestone with a functional Admin Dashboard, User Authentication, and Core Market Features.

### ✅ Completed Features

#### 🔹 **Core & Public**
*   **Landing Page**: Modern UI with Dark Mode, Hero section, and Live Market Marquee.
*   **News Aggregator**: Browsing, searching, and viewing financial news articles (`/news`).
*   **Global Search**: Integrated search functionality (`/search`).
*   **Market Reports**: Generated PDF market summaries (`/market-report/pdf`).

#### � **User System**
*   **Authentication**: Secure Login, Register, and Logout functionality.
*   **Profile Management**: Edit profile details.
*   **Watchlist**: Add/Remove assets to a personal watchlist.
*   **Price Alerts**: Set alerts for specific asset prices.
*   **Engagement**: Like and Comment on news posts.

#### 🔹 **Admin Dashboard** (`/admin`)
*   **Dashboard Overview**: Key metrics and stats.
*   **User Management**: Manage registered users.
*   **Content Management CRUD**:
    *   **Posts**: Create, Edit, Delete news articles.
    *   **Categories**: Manage news categories.
    *   **Tags**: Manage tagging system.

#### 🔹 **Technical & Infrastructure**
*   **Database**: Full schema implemented (Users, Posts, Comments, Likes, Assets, Watchlists, Alerts).
*   **Asset Management**: Vite integration for optimized CSS/JS.
*   **PDF Generation**: Integrated `dompdf` for reporting.

---

## 🛠 Tech Stack

*   **Framework**: [Laravel 12](https://laravel.com)
*   **Frontend**: [Tailwind CSS v4](https://tailwindcss.com) & [Alpine.js](https://alpinejs.dev)
*   **Build Tool**: [Vite](https://vitejs.dev)
*   **Database**: MySQL / SQLite (Configurable)
*   **PDF Engine**: `barryvdh/laravel-dompdf`

---

## ⚡ Getting Started

Follow these steps to set up the project locally:

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/Azhar457/FxFlare.git
    cd fxflare
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your `.env` file with your database credentials (default is often SQLite for dev).*

4.  **Database Migration**
    ```bash
    php artisan migrate
    ```

5.  **Run Development Servers**
    Open two terminal tabs:
    *   **Terminal 1 (Backend)**:
        ```bash
        composer run dev
        # Or: php artisan serve
        ```
    *   **Terminal 2 (Frontend)**:
        ```bash
        npm run dev
        ```

---

## 📂 Folder Structure

We follow a strict separation of concerns:

```
fxflare/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          <-- Dashboard, Users, Categories, Tags
│   │   ├── Auth/           <-- Authentication Logic
│   │   ├── PostController  <-- News Content
│   │   ├── ReportController<-- PDF Generation
│   │   └── ...
├── resources/
│   ├── views/
│   │   ├── dashboard/      <-- Admin Dashboard Views
│   │   ├── auth/           <-- Login/Register Views
│   │   ├── components/     <-- Reusable UI (Navbar, Cards, Alerts)
│   │   ├── news/           <-- Public News Views
│   │   ├── reports/        <-- PDF Layouts
│   │   └── ...
├── routes/
│   └── web.php             <-- All Application Routes
```

---

**Note**: Please ensure code quality standards are met before pushing changes. Use `php artisan test` to run tests.
