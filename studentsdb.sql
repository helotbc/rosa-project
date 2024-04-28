-- Create the database named 'students'
CREATE DATABASE students;

-- Use the newly created database
USE students;

-- Create the table named 'students'
CREATE TABLE students (
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  PRIMARY KEY (email) -- Set email as the primary key for efficient lookups
);
