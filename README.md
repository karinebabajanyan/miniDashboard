# Mini Dashboard

A small web app for managing student accounts, built with **Laravel 11**, **Vue 3** and **Inertia.js**.

An admin can create, search, edit and delete students. A student can log in and manage their own profile. Access is controlled with roles and permissions.

## Features

- **Role-based access** with [spatie/laravel-permission](https://github.com/spatie/laravel-permission): `admin` and `student` roles, guarded by middleware
- **Student management (admin):** paginated list, search, create, edit and delete (with modals and toast notifications)
- **Student profile:** students can view and update their own profile
- **Authentication** with Laravel Breeze: register, login, email verification, password reset
- **Service layer:** business logic lives in `UserService`, `ProfileService` and `CountryService` behind interfaces, so controllers stay thin
- **Form Request validation** for storing, updating and searching students
- **Seeders** for roles, permissions, countries, a default admin and sample students

## Tech stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2+, Laravel 11 |
| Frontend | Vue 3, Inertia.js, Tailwind CSS, Vite |
| Auth & roles | Laravel Breeze, Sanctum, spatie/laravel-permission |
| Database | MySQL |

## Project structure

```plaintext
app/
├── Http/
│   ├── Controllers/Admin/StudentController.php   # Admin CRUD for students
│   ├── Middleware/CheckRole.php                  # Role check
│   ├── Requests/                                 # Form Request validation
│   └── Resources/ShowStudentResource.php         # API resource for the students table
├── Models/                                       # User, Profile, Country
└── Services/                                     # Business logic behind interfaces
resources/js/Pages/
├── Admin/Student/                                # Index, Create, Edit/Delete modals
└── Profile/                                      # Student profile pages
```

## Getting started

```bash
git clone https://github.com/karinebabajanyan/miniDashboard.git
cd miniDashboard

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Set your database credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=your_db_name
DB_USERNAME=username
DB_PASSWORD=password
```

Run migrations with seed data, then start the servers:

```bash
php artisan migrate --seed
php artisan serve
npm run dev
```

## Demo login

The seeder creates an admin account for local testing:

- **Email:** `admin@example.com`
- **Password:** `password`

Sample students (`student1@example.com`, ...) use the same password. New users who register get the `student` role.
