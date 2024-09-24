# Wardrobe Management System

A simple Laravel-based application for managing wardrobe items, allowing users to add, edit, view, and categorize their clothes. The system also supports image uploads for each item and user authentication.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [License](#license)

## Overview

The **Wardrobe Management System** helps users keep track of their wardrobe items by organizing them based on categories like clothing type, color, size, and images. Users must be authenticated to add, edit, or delete wardrobe items. The system is built using Laravel and styled with Tailwind CSS as my design choice. 
The create and store routes are protected by an authentication mechanism, requiring users to be logged in to access the API endpoints.
Image Handling: Images are stored in the storage/app/public/images directory, and you need to link the storage folder to the public directory by running php artisan storage:link.
Validation: Each request is validated using Laravel's built-in validation, ensuring that required fields such as cloth_name, category, color, and size are provided.

## Features

- User authentication (login and register)
- Add and manage clothing items
- Categorize clothes by type, color, size, and image
- Upload images for each wardrobe item
- View all wardrobe items in a paginated list
- Edit and delete wardrobe items

## Installation

### Prerequisites

- PHP >= 8.0
- Composer
- Laravel
- Node.js and npm (for front-end assets)
- MySQL (or any supported database)

### Steps

1. **Clone the repository**:

    ```bash
    git clone https://github.com/your-username/wardrobe-system.git
    cd wardrobe-system
    ```

2. **Install PHP and JavaScript dependencies**:

    ```bash
    composer install
    npm install
    ```

3. **Set up environment variables**:

    - Copy the example `.env` file:

        ```bash
        cp .env.example .env
        ```

    - Update your `.env` file with your database credentials and other configuration options.

4. **Generate an application key**:

    ```bash
    php artisan key:generate
    ```

5. **Run migrations** to create the necessary database tables:

    ```bash
    php artisan migrate
    ```

6. **Seed the database** (optional, for generating dummy data):

    ```bash
    php artisan db:seed
    ```

7. **Run the local development server**:

    ```bash
    php artisan serve
    ```

8. **Compile the front-end assets**:

    ```bash
    npm run dev
    ```

9. **Link storage for images** (if necessary):

    ```bash
    php artisan storage:link
    ```

10. Visit `http://localhost:8000` in your browser to access the application.

## Usage

### User Authentication

1. Register a new account or log in using existing credentials.
2. Once authenticated, users can:
    - View all wardrobe items.
    - Add new wardrobe items.
    - Edit and delete existing items.
    - Upload images for each item.

### Adding New Items

- Navigate to the "Add New Item" page.
- Fill in details like the cloth name, category, color, size, and image.
- Submit the form to add the item to your wardrobe.

## API Endpoints

The Wardrobe Management System also exposes some API endpoints for interacting with wardrobe items.

### Available Endpoints

| Method | Endpoint            | Description                           |
|--------|---------------------|---------------------------------------|
| GET    | `/api/clothes`      | Fetch all wardrobe items              |
| POST   | `/api/clothes`      | Create a new wardrobe item            |
| GET    | `/api/clothes/{id}` | Fetch a specific wardrobe item        |
| PUT    | `/api/clothes/{id}` | Update a specific wardrobe item       |
| DELETE | `/api/clothes/{id}` | Delete a specific wardrobe item       |

### Example Request (POST `/api/clothes`):

```bash
POST /api/wardrobe
Content-Type: application/json

{
  "cloth_name": "Red Shirt",
  "category": "Shirts",
  "color": "Red",
  "size": "M",
  "image": "base64_encoded_image"
}
