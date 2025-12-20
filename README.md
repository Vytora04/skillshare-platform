# SkillBridge

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-6.0-646CFF?style=for-the-badge&logo=vite&logoColor=white)

**SkillBridge** is a web-based platform designed to facilitate skill sharing and collaboration between individuals and non-profit organizations.

## 🛠 Features

- **Authentication**: Custom registration flow with specific role selection (Seeker vs. Provider).
- **Role-Based Access**: System supports distinct permissions for Seekers, Providers, Organization Reps, and Admins.
- **Skill Matching**: Uses a tag-based system to categorize and recommend relevant projects.
- **Project Structure**: Includes project rooms with milestones, task boards, and basic team chat.
- **Document Verification**: Workflow for organizations to submit credentials for admin review.
- **Unified Legal View**: Consolidated page for accessing Privacy Policy and Terms of Service.

---

## 💻 Installation

1.  **Clone & Install**
    ```bash
    git clone https://github.com/yourusername/SkillBridge.git
    cd SkillBridge
    composer install
    npm install
    ```

2.  **Configuration**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3.  **Database**
    ```bash
    php artisan migrate --seed
    ```
    *(Uses SQLite by default)*

4.  **Run**
    ```bash
    npm run dev
    php artisan serve
    ```

---

## � Demo Accounts

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin/Mod** | `moderator@skillbridge.test` | `password` |
| **User** | `user@skillbridge.test` | `password` |

---

## 📂 Structure

- `app/Models`: User, Project, SkillPost, Invitation
- `resources/views/auth`: Custom Blade templates for login/register
- `resources/views/projects`: Project management interfaces
- `routes/web.php`: Main application routes

## License
MIT License.
