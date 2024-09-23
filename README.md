# Wardrobe Access Application 

This project is a wardrobe management system that allows users to register, log in, and manage their wardrobe items. The backend is built using Laravel APIs, while the frontend uses Vue.js and Tailwind CSS for the user interface.

## Repository Overview

- **Frontend Repository**: [wardrobe-management-front](https://github.com/uzapoint/wardrobe-management-front/tree/tamminga_budds)
- **Backend API Repository**: [wardrobe-management-system](https://github.com/uzapoint/wardrobe-management-system/tree/tamminga_budds)

## Technologies Used

- **Backend**: Laravel (PHP framework) for API development, authentication, and database management.
- **Frontend**: Vue.js (JavaScript framework) and Tailwind CSS for creating responsive user interfaces.

## Project Setup

### Backend (Laravel)

1. **Clone the repository**:
   ```bash
   git clone https://github.com/uzapoint/wardrobe-management-system.git
   git branch checkout tamminga_budds
   cd wardrobe-management-system
   ```
2. **Install Dependencies:**:
   ```
   composer install

   ```
3. **Environment Configuration:**:
Create a new ```.env``` file by copying ```.env.example```
   ```
   cp .env.example .env

   ```
4. **Generate Application Key:**:

   ```
   php artisan key:generate

   ```
5. **Run Database Migrations:**:

   ```
   php artisan migrate

   ```
## Folder Structure

### Backend (Laravel):

- `routes/api.php`: API route definitions.
- `app/Http/Controllers/`: Controllers handling API logic.
- `app/Models/`: Database models.



## Deployment

### Backend:

- Deploy the Laravel application on a PHP-supported server.
- Ensure the server is configured to run Laravel and manage the database connection.