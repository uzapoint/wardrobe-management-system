# Wardrobe App

## Project Description

The **Wardrobe App** is a web application that allows users to register, log in, and manage their clothing items. The app utilizes a modern stack including Vue.js for the frontend, Laravel for the backend, and a RESTful API to handle user authentication and data management. 

## Installation Instructions

To set up the project locally, follow these instructions:

### Prerequisites

- **Node.js** (version 18 or later)
- **Vue.js** (version 2 or later)
- **Laravel** (version 10 or later)
- **Composer** (for PHP package management)
- **Database** (MySQL or SQLite recommended)

### Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/wardrobe-app.git
   cd wardrobe-app


# API Documentation

### Login

POST `/api/login`

Description

This endpoint allows users to log in and receive an authentication token that can be used to access protected routes in the wardrobe management system.
* Request Headers

- Content-Type: application/json

### Example Request

POST /api/login HTTP/1.1
Host: 127.0.0.1:8000
Content-Type: application/json

`{`
    `"email": "user@example.com",`
    `"password": "password"`
`}`

### Response
Success Response

- Status Code: 200 OK
* Body

- json
`{`
    `"token": "your-generated-token"`
`}`
#### token: The authentication token for the user, which can be used for subsequent requests to protected routes.


### Error Responses
- Invalid Credentials

- Status Code: 401 Unauthorized
- Body
- json

`{`
 `   "message": "Invalid credentials"`
`}`

### Example Error Response

http

HTTP/1.1 401 Unauthorized
Content-Type: application/json

`{`
   ` "message": "Invalid credentials"`
`}`

### Initiate Password Reset

#### Endpoint: POST /api/forgot-password

Description: This endpoint sends a password reset link to the user's email address.

* Request Headers:
- Content-Type: application/json
- Request Body:
json

`{`
   ` "email": "user@example.com"`
`}`

#### Response:
- Success (200 OK):
- json

`{`
 `   "message": "We have emailed your password reset link."`
`}`

#### Error (400 Bad Request):

- json

`{`
   ` "message": "The provided email address is not registered."`
`}`

# Clothing Item Controller

## Overview

The **Clothing Item Controller** is part of the Wardrobe App's backend API, which manages clothing items. It allows users to perform CRUD (Create, Read, Update, Delete) operations on clothing items, including uploading images and associating items with categories.

## API Endpoints

### 1. Get All Clothing Items

- **Endpoint**: `GET /clothing-items`
- **Description**: Retrieves all clothing items, including their associated category names.
- **Response**:
  - **Success**: Returns a JSON array of clothing items.
  - **Error**: 500 Internal Server Error.

### 2. Get a Single Clothing Item

- **Endpoint**: `GET /clothing-items/{id}`
- **Description**: Retrieves a specific clothing item by its ID.
- **Parameters**:
  - `id` (integer): The ID of the clothing item.
- **Response**:
  - **Success**: Returns a JSON object of the clothing item.
  - **Error**: 404 Not Found if the item does not exist.

### 3. Create a New Clothing Item

- **Endpoint**: `POST /clothing-items`
- **Description**: Creates a new clothing item with the provided data.
- **Request Body**:
  ```json
  {
    "name": "T-Shirt",
    "size": "M",
    "color": "Red",
    "material": "Cotton",
    "category_id": 1,
    "image": "file" // Optional
  }```

## Update an Existing Clothing Item

    Endpoint: PUT /clothing-items/{id}
    Description: Updates a specific clothing item by its ID.
    Parameters:
        id (integer): The ID of the clothing item to update.
    Request Body:

    json

```{
  "name": "Updated T-Shirt",
  "size": "L",
  "color": "Blue",
  "material": "Polyester",
  "category_id": 2,
  "image": "file" // Optional
}```

- Response:

    Success: Returns the updated clothing item as a JSON object.
    Error: 404 Not Found if the item does not exist, 422 Unprocessable Entity for validation errors.

## Delete a Clothing Item

    Endpoint: DELETE `/clothing-items/{id}`
    Description: Deletes a specific clothing item by its ID.
    Parameters:
        id (integer): The ID of the clothing item to delete.
    Response:
        Success: Returns a success message.
        Error: 404 Not Found if the item does not exist.
