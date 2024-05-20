# Task Management Application

This is a task management application built with Laravel, a powerful PHP web application framework. It provides role-based access control, allowing regular users to create, view, edit, and delete their tasks, while an admin user has additional privileges to manage all tasks and user accounts.

## Features

- **User Authentication**: User registration and login functionality implemented with Laravel Jetstream.
- **Roles**: Two roles are defined - Admin and Regular User.
- **Admin Role**: Admins can view all tasks created by any user, perform CRUD operations on tasks and user accounts.
- **User Role**: Regular users can create tasks with a title and description, view, edit, and delete their tasks.
- **Task Categories**: Tasks can be categorized by name and color. Users can create, edit, and delete categories.
- **Task Status**: Tasks can have statuses like To-Do, In Progress, and Done. Users can update the status of their tasks.
- **Task Filtering and Sorting**: Users can filter and sort their tasks by category, status, and creation date.
- **Interface and Validation**: The application ensures data integrity with validation rules for task actions and uses Laravel's Blade and Bootstrap for a clean, user-friendly interface.
- **Testing and Documentation**: Basic PHP Unit tests are included for key functionalities, and this README file provides setup and running instructions.

## Used Technolgies
- Laravel
- Html
- css
- Boostrap
- SQLlite

## Installation

1. Clone the repository: `git clone https://github.com/your-username/task-management-app.git`
2. Navigate to the project directory: `cd task-management-app`
3. Install dependencies: `composer install`
4. Create a copy of the `.env.example` file and rename it to `.env`
5. Generate an application key: `php artisan key:generate`
6. Configure your database credentials in the `.env` file
7. Run database migrations: `php artisan migrate`
8. (Optional) Seed the database with initial data: `php artisan db:seed`
9. Start the development server: `php artisan serve`

## Testing

To run the PHP Unit tests, execute the following command:
