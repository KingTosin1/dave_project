# Course Registration & Result Processing System - TODO Plan

This is a simple, clean, and fast Laravel 10 + Blade system for ND student defence in Nigeria. Focus on core features with professional UI. Finish by tomorrow.

## Phase 1: Project Setup & Installation (1-2 hours)

-   [x] Install Laravel 10: Run `composer create-project laravel/laravel .` in c:/xampp/htdocs/laravel/dave_project
-   [x] Configure .env: Set DB to MySQL (XAMPP), generate key
-   [ ] Install Breeze: `composer require laravel/breeze --dev` and `php artisan breeze:install blade`
-   [ ] Install Datatables: `composer require yajra/laravel-datatables-oracle`
-   [ ] Create DB: In phpMyAdmin, create 'dave_project' DB
-   [ ] Run Breeze: `php artisan migrate` and `npm install && npm run build`

## Phase 2: Backend (Migrations, Models, Controllers) (2-3 hours)

-   [ ] Migrations: Create tables for users, students, courses, registrations, lecturer_courses, grades
-   [ ] Models: User, Student, Course, Registration, LecturerCourse, Grade with relationships
-   [ ] Controllers: DashboardController, StudentController, LecturerController, AdminController
-   [ ] Routes: Define web routes with role middleware
-   [ ] Seed admin: Create AdminSeeder for default admin user
-   [ ] Logic: GPA calculation, role redirects, validations

## Phase 3: Frontend (Blade Views & UI) (3-4 hours)

-   [ ] Master layout: app.blade.php with Bootstrap 5, FontAwesome, Poppins, SweetAlert2
-   [ ] Auth views: Customize login/register
-   [ ] Dashboards: Admin (stats), Lecturer (courses), Student (GPA/cards)
-   [ ] Student: Register courses (datatable), view results, print transcript
-   [ ] Lecturer: View courses, upload/edit marks
-   [ ] Admin: CRUD tables for users/courses, approve registrations, assign courses
-   [ ] Responsive: Mobile-friendly, hover effects, SweetAlert confirms

## Phase 4: Testing & Finalization (1-2 hours)

-   [ ] Test flows: Register → Approve → Upload marks → View results
-   [ ] UI check: Responsive, professional look
-   [ ] Seed data: Add sample students/courses
-   [ ] Optimize: Cache config/routes
-   [ ] Deploy locally: Run `php artisan serve` and test in browser

Total time: ~8-10 hours. Prioritize simplicity.
