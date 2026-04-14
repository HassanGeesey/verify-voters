-- Student Voting System Database
-- Run this SQL in phpMyAdmin or MySQL CLI

CREATE DATABASE IF NOT EXISTS voting_system;
USE voting_system;

-- Main students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    department VARCHAR(100) NOT NULL,
    has_voted BOOLEAN DEFAULT FALSE,
    voted_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_student_id (student_id),
    INDEX idx_has_voted (has_voted)
);

-- Insert sample data for testing
INSERT INTO students (student_id, name, department) VALUES
('STU001', 'Ahmed Mohamed', 'Computer Science'),
('STU002', 'Fatima Ali', 'Business Administration'),
('STU003', 'Mohamed Hassan', 'Engineering'),
('STU004', 'Aisha Ibrahim', 'Medicine'),
('STU005', 'Omar Yusuf', 'Law'),
('STU006', 'Khadija Ahmed', 'Computer Science'),
('STU007', 'Abdi Karim', 'Business Administration'),
('STU008', 'Halima Omar', 'Engineering'),
('STU009', 'Ibrahim Salad', 'Medicine'),
('STU010', 'Samatar Ali', 'Law');
