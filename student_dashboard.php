<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - AlooTeach</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="../../js/scripts.js"></script>
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
    </header>
    <main>
        <section id="courses">
            <h2>Your Courses</h2>
            <ul id="course-list">
                <!-- Courses will be dynamically loaded here -->
            </ul>
        </section>

        <section id="notifications">
            <h2>Notifications</h2>
            <ul id="notification-list">
                <!-- Notifications will be dynamically loaded here -->
            </ul>
        </section>
    </main>
    <script>
        // Fetch enrolled courses and notifications
        fetch('../../backend/routes.php?dashboard=true')
            .then(response => response.json())
            .then(data => {
                const courseList = document.getElementById('course-list');
                data.courses.forEach(course => {
                    const li = document.createElement('li');
                    li.textContent = course.name + ' - ' + course.description;
                    courseList.appendChild(li);
                });

                const notificationList = document.getElementById('notification-list');
                data.notifications.forEach(notification => {
                    const li = document.createElement('li');
                    li.textContent = notification.message;
                    notificationList.appendChild(li);
                });
            });
    </script>
</body>
</html>
