<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AlooTeach</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <header>
        <h1>Register at AlooTeach</h1>
    </header>
    <main>
        <form action="../../backend/routes.php" method="POST">
            <input type="hidden" name="action" value="register">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="student">Student</option>
                <option value="employee">Employee</option>
            </select>

            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>
