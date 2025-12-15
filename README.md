# SkillBridge - Skill Sharing Platform

SkillBridge is a comprehensive skill-sharing platform built with Laravel, enabling users to exchange skills, collaborate on projects, and build meaningful connections. Built in alignment with **UN SDG 17: Partnerships for the Goals**.

## Features

### Core Features
1. **Email Verification & Authentication** - Secure user registration with email verification and password reset functionality
2. **Multi-Role System** - Users can have multiple roles: Skill Provider, Skill Seeker, Organization Representative, Admin, and Moderator
3. **Enhanced User Profiles** - Customizable profiles with avatars, skills, bio, location, and social links
4. **Tag-Based Matching** - Smart recommendations connecting skill offers with skill needs using tag-based matching
5. **Invitation System** - Users can invite others or apply to skill posts with accept/reject workflow
6. **Project Rooms** - Collaborative project spaces with milestones and task tracking
7. **In-App Messaging** - Direct messaging between users for seamless communication
8. **Organization Verification** - Org representatives can submit verification documents for admin approval
9. **Admin Dashboard** - Platform statistics and user management for admins and moderators

## Requirements

- PHP >= 8.2
- Composer >= 2.8
- Node.js >= 18 and npm
- SQLite (default) or MySQL/PostgreSQL

## Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/SkillBridge.git
cd SkillBridge
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node dependencies**
```bash
npm install
```

4. **Set up environment**
```bash
copy .env.example .env
php artisan key:generate
```

5. **Configure database**
- Default: SQLite (no configuration needed)
- For MySQL/PostgreSQL: Update `.env` with your database credentials

6. **Run migrations and seed demo data**
```bash
php artisan migrate --seed
```

7. **Build frontend assets**
```bash
npm run build
```

8. **Start development server**
```bash
php artisan serve
```

9. **Start Vite dev server** (in another terminal)
```bash
npm run dev
```

Visit `http://127.0.0.1:8000` in your browser.

## Demo Credentials

Two demo accounts are created during seeding:

### Moderator Account (All Roles)
- Email: `moderator@skillbridge.test`
- Password: `password`
- Roles: Admin, Moderator, Provider, Seeker, Organization Representative

### Regular User Account
- Email: `user@skillbridge.test`
- Password: `password`
- Roles: Skill Provider, Skill Seeker

## Project Structure

```
SkillBridge/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Application controllers
│   │   └── Middleware/       # Role-based middleware
│   └── Models/               # Eloquent models
├── database/
│   ├── migrations/           # Database schema
│   └── seeders/              # Database seeders
├── resources/
│   ├── views/                # Blade templates
│   ├── css/                  # Stylesheets
│   └── js/                   # JavaScript files
└── routes/
    └── web.php               # Web routes
```

## Key Technologies

- **Backend**: Laravel 12, PHP 8.2
- **Frontend**: Blade Templates, TailwindCSS 4.0, Alpine.js
- **Database**: SQLite (default), MySQL/PostgreSQL supported
- **Build Tools**: Vite 7.0
- **Email**: Log driver (development), SMTP ready for production

## Database Models

- **User** - User accounts with multi-role support
- **SkillPost** - Skill offers and needs with tags
- **Tag** - Skill categorization for matching
- **Invitation** - Invitation/application workflow
- **Project** - Collaborative project rooms
- **Milestone** - Project milestones
- **Task** - Project tasks
- **Conversation** - User messaging threads
- **Message** - Individual messages
- **OrgVerification** - Organization verification documents

## Development

### Running Tests
```bash
php artisan test
```

### Building for Production
```bash
npm run build
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## License

This project is open-sourced software licensed under the MIT license.

## Contributing

This is a university course project. Contributions are welcome through pull requests.

## Support

For issues and questions, please open an issue on GitHub.
