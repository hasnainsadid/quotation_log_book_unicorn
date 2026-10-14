<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
    <h2>Hello, {{ $user->name }}</h2>
    <p>Welcome to our platform! Your account has been successfully created.</p>
    <p>Email: {{ $user->email }}</p>
    <p>Phone Number: {{ $user->phone }}</p>
</body>
</html>