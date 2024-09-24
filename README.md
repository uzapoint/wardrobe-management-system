
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

