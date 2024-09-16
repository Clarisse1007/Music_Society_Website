DROP SCHEMA IF EXISTS myAssignment2043;
CREATE SCHEMA myAssignment2043;         
USE myAssignment2043;

CREATE TABLE events (
	event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_title VARCHAR (100) NOT NULL,
	event_description VARCHAR (2000) NOT NULL,
	event_date_time VARCHAR (20) NOT NULL,
    event_image1 VARCHAR (20) NOT NULL,
    total_seat INT NOT NULL
);


INSERT INTO events (event_title, event_description, event_date_time, event_image1, total_seat) VALUES 
                    ('Live Rock Music Festival', 'Let us Rock the night away!', '17/08/2023 6:00pm', 'event1.png', 30),
                    ('Music Festival', 'This festival allow students to shine with their talent of singing', '20/01/2024 1:00pm', 'event2.png', 25),
                    ('Retro Party', 'Let us travel back to the past and have a great time together!', '22/04/2030 6:30pm', 'event3.png', 40);

CREATE TABLE members (
	member_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	member_name VARCHAR (20) NOT NULL,
	member_password VARCHAR (20) NOT NULL,		
	member_login_status VARCHAR (2) NOT NULL,
    member_gmail VARCHAR (20) NOT NULL,
    email_status VARCHAR(10) NOT NULL

);

INSERT INTO members (member_id, member_name, member_password, member_login_status,member_gmail, email_status) 
VALUES ('1', 'member1', '123', 'M','member1@gmail.com','inactive');
INSERT INTO members (member_id, member_name, member_password, member_login_status,member_gmail, email_status) 
VALUES ('2', 'admin1', '123', 'A','admin1@gmail.com','inactive');
                   
CREATE TABLE feedback (
    feedback_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    event_id INT NOT NULL,
    member_id INT NOT NULL,
    feedback_text VARCHAR(2000) NOT NULL,
    rating VARCHAR(20) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO feedback (feedback_id, event_id, member_id, feedback_text, rating)
VALUES (1, 1, 1, 'Great event!', '5');

CREATE TABLE IF NOT EXISTS booking (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    member_id INT NOT NULL,
    event_id INT NOT NULL,
    quantity INT NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Success', 'Canceled', 'Pending', 'Failed') DEFAULT 'pending',
    FOREIGN KEY (member_id) REFERENCES members(member_id),
    FOREIGN KEY (event_id) REFERENCES events(event_id)
);

INSERT INTO booking (member_id, event_id, quantity, booking_date, status)
VALUES (1, 1, 1, '2024-05-14 10:00:00','Success');