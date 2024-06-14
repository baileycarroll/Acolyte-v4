CREATE TABLE accounts (
    id int AUTO_INCREMENT PRIMARY KEY,
    student_id varchar(255) UNIQUE NOT NULL,
    username varchar(255) UNIQUE,
    password varchar(255),
    priv_and_tos int DEFAULT 0,
    admin int DEFAULT 0
);

CREATE TABLE students (
    id int AUTO_INCREMENT PRIMARY KEY,
    student_id varchar(255) UNIQUE NOT NULL,
    account_status varchar(255) DEFAULT 'Suspended',
    membership varchar(255) DEFAULT 'Inactive',
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    phone varchar(255),
    email varchar(255) UNIQUE NOT NULL
);

CREATE TABLE gradebook (
    id int AUTO_INCREMENT PRIMARY KEY,
    module varchar(255) UNIQUE NOT NULL,
    student_id varchar(255),
    FOREIGN KEY (student_id) REFERENCES accounts(student_id)
);

ALTER TABLE accounts
    ADD FOREIGN KEY (student_id) REFERENCES students(student_id);

INSERT INTO students (student_id, account_status, membership, first_name, last_name, phone, email) VALUES ('gw_0001', 'Active', 'Active', 'Acolyte', 'Support', NULL, 'support@example.com');

INSERT INTO `accounts` (`id`, `student_id`, `username`, `password`, `priv_and_tos`, `admin`) VALUES (NULL, 'gw_0001', 'acolyte', '$2y$10$dhSxvfMOKMNNidn0uy2K.eoXlwI9AAmpu3.Sb.qROKoSrL/xDXJL2', '1', '1');