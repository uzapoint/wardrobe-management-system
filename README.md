
# API Documentation

### Login

POST `/api/login`

Description

This endpoint allows users to log in and receive an authentication token that can be used to access protected routes in the wardrobe management system.
Request
Headers

    Content-Type: application/json


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

Status Code: 200 OK
Body

json
`{`
    `"token": "your-generated-token"`
`}`
#### token: The authentication token for the user, which can be used for subsequent requests to protected routes.


### Error Responses
-Invalid Credentials

-Status Code: 401 Unauthorized
-Body
-json

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
