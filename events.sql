DROP SCHEMA IF EXISTS myAssignment2043;
CREATE SCHEMA myAssignment2043;         
USE myAssignment2043;

CREATE TABLE events (
	event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_title VARCHAR (100) NOT NULL,
	event_description VARCHAR (2000) NOT NULL,
	event_date_time VARCHAR (20) NOT NULL,
        event_image1 VARCHAR (20) NOT NULL 
);


INSERT INTO events (event_title, event_description, event_date_time, event_image1) VALUES 
                    ('Live Rock Music Festival', 'Let us Rock the night away!', '17/08/2023 6:00pm', 'event1.png'),
                    ('Music Festival', 'This festival allow students to shine with their talent of singing', '20/01/2024 1:00pm', 'event2.png'),
                    ('Retro Party', 'Let us travel back to the past and have a great time together!', '22/04/2030 6:30pm', 'event3.png');

                   
