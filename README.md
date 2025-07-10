# CentreCLAS - E-Learning Platform

<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

CentreCLAS is a comprehensive e-learning platform built with Laravel that offers professional training in multimedia and information technology fields.

## About CentreCLAS

CentreCLAS is a professional training center that provides courses in various technology fields including:

- **Digital Marketing**
- **Artificial Intelligence**
- **Graphic Design**
- **Data Analytics with Power BI**
- **Algorithm: Python / C**
- **Object-Oriented Programming in Java**
- **MERN Stack**
- **WordPress**
- **DevOps**
- **Backend Web Development**
- **Frontend Web Development**
- **Angular and .NET**
- **Angular and Laravel**
- **MEAN Stack**

## Features

### 🎓 **Student Features**
- Course enrollment and management
- Access to course materials (PDFs, timetables)
- Student dashboard with enrolled sessions
- Download course materials and schedules
- Interactive chatbot for navigation help
- Personal account settings management

### 👨‍🏫 **Teacher Features**
- Manage assigned sessions
- Upload course materials and timetables
- View enrolled students
- Session management interface
- Course file management system

### 👨‍💼 **Admin Features**
- Student and teacher management
- Formation (course) management
- Session creation and management
- Enrollment approval system
- Dashboard with statistics
- Message management system

### 🤖 **Chatbot Integration**
- Interactive help system
- Navigation assistance
- Course information queries
- Support contact guidance

## Technology Stack

- **Backend**: Laravel 10
- **Frontend**: Blade Templates, Bootstrap 5, Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **File Management**: Laravel Storage
- **JavaScript**: Custom validations and interactions
- **Icons**: Font Awesome
- **Build Tools**: Vite, PostCSS

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/trabelsi-mohamed-amine/centreclas-elearning-platform.git
   cd centreclas-elearning-platform
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   # Configure your database credentials in .env file
   php artisan migrate
   php artisan db:seed
   ```

5. **Storage link**
   ```bash
   php artisan storage:link
   ```

6. **Compile assets**
   ```bash
   npm run dev
   # or for production
   npm run build
   ```

7. **Start the application**
   ```bash
   php artisan serve
   ```

## User Roles

- **Admin** (role_id: 1): Full system access
- **Teacher/Formateur** (role_id: 2): Manage sessions and students
- **Student** (role_id: 3): Access courses and materials

## Key Models

- **User**: Handles authentication and user roles
- **Formation**: Course categories/programs
- **Session**: Individual class sessions
- **Enrollment**: Student-session relationships
- **CourseFile**: File attachments for courses
- **AdminMessage**: Chatbot responses

## File Structure

```
app/
├── Http/Controllers/
│   ├── AccountController.php      # Account management
│   ├── ChatbotController.php      # Chatbot functionality
│   ├── CourseFileController.php   # Course file management
│   ├── DashboardController.php    # Dashboard views
│   ├── FormationController.php    # Course management
│   ├── SessionController.php      # Session management
│   ├── StudentController.php      # Student operations
│   └── TeacherController.php      # Teacher operations
├── Models/
│   ├── Formation.php              # Course model
│   ├── Session.php                # Session model
│   ├── Enrollment.php             # Enrollment model
│   ├── CourseFile.php             # Course file model
│   └── AdminMessage.php           # Chatbot message model
└── View/Components/               # Reusable view components

resources/views/
├── formation/                     # Course management views
├── sessions/                      # Session management views
├── teacher/                       # Teacher-specific views
├── components/                    # Reusable components
└── auth/                         # Authentication views
```

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
