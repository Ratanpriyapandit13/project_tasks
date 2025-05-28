-- 1. employees table
CREATE TABLE employees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    position VARCHAR(100),
    hired_date DATE
);


-- 2. deleted_employees table
CREATE TABLE deleted_employees (
    id INT,
    name VARCHAR(100),
    email VARCHAR(100),
    position VARCHAR(100),
    hired_date DATE,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- trigger
DELIMITER $$

CREATE TRIGGER after_employee_delete
AFTER DELETE ON employees
FOR EACH ROW
BEGIN
    INSERT INTO deleted_employees (id, name, email, position, hired_date, deleted_at)
    VALUES (OLD.id, OLD.name, OLD.email, OLD.position, OLD.hired_date, NOW());
END $$

DELIMITER ;
