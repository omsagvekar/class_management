SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Table structure for table `login_user`
CREATE TABLE login_user (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(20) NOT NULL,
    `password` varchar(255) NOT NULL -- Hash passwords before storing
);

INSERT INTO login_user (username, password) VALUES ('sanjay','Sanjay');
INSERT INTO login_user (username, password) VALUES ('admin','Admin');

-- Table structure for table `students`
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    address_street VARCHAR(255) NOT NULL,
    address_city VARCHAR(100) NOT NULL,
    address_state VARCHAR(100) NOT NULL,
    address_zip VARCHAR(20) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    guardian_name VARCHAR(100),
    guardian_relationship VARCHAR(50),
    guardian_contact_number VARCHAR(20),
    guardian_email VARCHAR(100),
    admission_date DATE NOT NULL,
    roll_number INT NOT NULL,
    standard INT NOT NULL
);

-- Table structure for table `Fees`

CREATE TABLE Fees (
    `Fees_ID` int PRIMARY KEY AUTO_INCREMENT,
    `Total_Fees` DECIMAL(10, 2) NOT NULL,
    `Paid_Fees` DECIMAL(10, 2) NOT NULL,
    `Last_Payment` DECIMAL(10 , 2) NOT NULL,
    `Balance_Fees` DECIMAL(10, 2) NOT NULL,
    `Last_Payment_Date` DATE NOT NULL,
    `student_id` int,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE
);

CREATE TABLE Teachers (
    T_ID INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    qualification VARCHAR(50) NOT NULL,
    year_of_experience INT NOT NULL,
    address_street VARCHAR(255) NOT NULL,
    address_city VARCHAR(100) NOT NULL,
    address_state VARCHAR(100) NOT NULL,
    address_zip VARCHAR(20) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    date_of_joining DATE NOT NULL,
    pay_per_hour DECIMAL(7,2)
);

CREATE TABLE Slots (
    Slot_ID INT AUTO_INCREMENT PRIMARY KEY,
    Teacher_ID INT,
    Slot_Date DATE,
    From_Time TIME,
    To_Time TIME,
    Duration_Hours FLOAT,
    FOREIGN KEY (Teacher_ID) REFERENCES Teachers(T_ID)
);


COMMIT;
