-- Create Database
CREATE DATABASE AlooTeachDB;

USE AlooTeachDB;

-- Users Table
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student', 'employee') NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Students Table
CREATE TABLE Students (
    user_id INT PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    consultant_id INT,
    FOREIGN KEY (consultant_id) REFERENCES Users(id) ON DELETE SET NULL
);

-- Employees Table
CREATE TABLE Employees (
    user_id INT PRIMARY KEY,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    field_of_study ENUM('Experimental Sciences', 'Mathematics') NOT NULL,
    subjects VARCHAR(255) NOT NULL  -- CSV format for subjects they can teach
);

-- Courses Table
CREATE TABLE Courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    field_of_study ENUM('Experimental Sciences', 'Mathematics') NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Enrollments Table
CREATE TABLE Enrollments (
    student_id INT,
    course_id INT,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES Students(user_id),
    FOREIGN KEY (course_id) REFERENCES Courses(id)
);

-- Consultant Assignments Table
CREATE TABLE ConsultantAssignments (
    student_id INT PRIMARY KEY,
    consultant_id INT,
    FOREIGN KEY (student_id) REFERENCES Students(user_id),
    FOREIGN KEY (consultant_id) REFERENCES Employees(user_id)
);

-- Notifications Table
CREATE TABLE Notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);
