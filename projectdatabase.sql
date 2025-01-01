create database if not exists task_db;
Use task_db;
CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT, 
    title VARCHAR(500) NOT NULL,
    description VARCHAR(500),
    status ENUM('Pending', 'In Progress', 'Completed') NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);
ALTER TABLE tasks ADD due_date date;

INSERT INTO tasks (title, description, status,due_date)
VALUES 
('Complete SQL report', 'Prepare the monthly SQL report', 'In Progress','2025-01-04'),
('Fix application bugs', 'Resolve all reported issues', 'Completed','2025-01-01'),
('Team meeting', 'Attend the weekly team meeting', 'Pending','2025-01-05');

select*from tasks;
select * from tasks WHERE status = 'Pending';
select * from tasks WHERE due_date='2025-01-04';

SET SQL_SAFE_UPDATES = 0;

UPDATE tasks SET status = 'In Progress' WHERE status = 'Completed';
UPDATE tasks SET due_date='2025-01-06' WHERE due_date='2025-01-04';

DELETE FROM tasks WHERE id = 2;
DELETE FROM tasks WHERE status = 'Completed';

