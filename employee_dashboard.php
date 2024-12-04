<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - AlooTeach</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="../../js/scripts.js"></script>
</head>
<body>
    <header>
        <h1>Welcome to Your Employee Dashboard</h1>
    </header>
    <main>
        <section id="students">
            <h2>Assigned Students</h2>
            <ul id="student-list">
                <!-- Assigned students and courses will be loaded here -->
            </ul>
        </section>
    </main>
    <script>
        // Fetch assigned students and courses
        fetch('../../backend/routes.php?dashboard=true')
            .then(response => response.json())
            .then(data => {
                const studentList = document.getElementById('student-list');
                data.students.forEach(student => {
                    const li = document.createElement('li');
                    li.textContent = student.course_name + ' - ' + student.user_id;
                    studentList.appendChild(li);
                });
            });
    </script>
</body>
</html>
