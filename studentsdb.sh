#!/bin/bash

# Replace with your MySQL connection details (ensure these are secured using secrets in production)
MYSQL_HOST="mysql"  # Replace with your MySQL service name
MYSQL_USER="$MYSQL_USER"
MYSQL_PASSWORD="$MYSQL_PASSWORD"

# Connect to MySQL server and execute commands
mysql -h $MYSQL_HOST -u $MYSQL_USER -p$MYSQL_PASSWORD << EOF

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

EOF

echo "Database schema initialized successfully!"

exit 0