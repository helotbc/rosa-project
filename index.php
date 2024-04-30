<?php

// Get secrets from ROSA and load into variables
// Database connection details (replace with your own)
#$username = getenv('DB_USER');
#if ($username === false) {
#  throw new Exception('Failed to retrieve ROSA secret from environment');
#}

$password = getenv('database-root-password');
if ($password === false) {
  throw new Exception('Failed to retrieve ROSA secret from environment');
}

$dbname = getenv('database-name');
if ($dbname === false) {
    throw new Exception('Failed to retrieve ROSA secret from environment');
}

#$table = "students";
#if ($table === false) {
#  throw new Exception('Failed to retrieve ROSA secret from environment');
#}

// These are the hardcoded database variables
$servername = "mysql";
$username = "root";
# $password = "this-is-the-root-785-password";
# $dbname = "students";
$tablename = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to display all data from the database
function displayData($conn) {
  $sql = "SELECT * FROM students";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<table>
            <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Email</th>
            </tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>" . $row["firstname"] . "</td>
              <td>" . $row["lastname"] . "</td>
              <td>" . $row["email"] . "</td>
            </tr>";
    }
    echo "</table>";
  } else {
    echo "No data found";
  }
}

// Handle form submission (if method is POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = $conn->real_escape_string($_POST["firstname"]);
  $lastname = $conn->real_escape_string($_POST["lastname"]);
  $email = $conn->real_escape_string($_POST["email"]);

  $sql = "INSERT INTO $tablename (firstname, lastname, email)
  VALUES ('$firstname', '$lastname', '$email')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration</title>
</head>
<body ="background-color: red;">
  <h1>Student Registration</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="firstname">Firstname:</label><br>
    <input type="text" id="firstname" name="firstname"><br><br>
    <label for="lastname">Lastname:</label><br>
    <input type="text" id="lastname" name="lastname"><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br><br>
    <input type="submit" value="Submit">
  </form>

  <h2>Registered Students</h2>
  <?php displayData($conn); ?>

  <?php
  $conn->close();
  ?>
</body>
</html>
