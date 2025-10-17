# GEMINI.md

## Project Overview

This is a `laravel/react-starter-kit` project. It's a skeleton application for the Laravel framework, built with a React front-end.

*   **Backend:** Laravel 12, PHP 8.4
*   **Frontend:** React, Vite, TypeScript
*   **UI:** Radix UI, Tailwind CSS
*   **Authentication:** Laravel Fortify
*   **Database:** Configured for SQLite by default, but can be changed in `.env`.
*   **Testing:** Pest

## Building and Running

### Setup

1.  Copy `.env.example` to `.env` and configure your environment variables.
2.  Run `composer install` to install PHP dependencies.
3.  Run `npm install` to install JavaScript dependencies.
4.  Run `php artisan key:generate` to generate an application key.
5.  Run `php artisan migrate` to run database migrations.

### Development

*   `npm run dev`: Starts the Vite development server for the front-end.
*   `php artisan serve`: Starts the Laravel development server for the back-end.
*   `composer run dev`: Runs both of the above concurrently.

### Testing

*   `composer test`: Runs the entire test suite.
*   `composer test:unit`: Runs unit tests.
*   `composer test:lint`: Runs linting checks.
*   `composer test:types`: Runs static analysis.

## Development Conventions

*   **Linting:** ESLint and Prettier are used for code formatting and linting. Use `npm run format` to format your code.
*   **Commits:** No explicit commit conventions are defined, but the presence of `pint.json` and `rector.php` suggests a focus on code style and quality.
*   **Branching:** No explicit branching strategy is defined.
