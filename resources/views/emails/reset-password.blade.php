<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>To reset your password, click the link below:</p>
    <a href="{{ 'http://127.0.0.1:8080/reset?token=' . $token }}">Reset Password</a>
    </body>
</html>
