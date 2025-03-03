<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volunteer Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      background: radial-gradient(#6a11cb, #2575fc);
      color: white;
      padding: 20px;
    }
    .container {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      max-width: 550px;
      margin: auto;
      color: #333;
    }
    h2 {
      color: #6a11cb;
    }
    input, select, button {
      width: 100%;
      padding: 12px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    button {
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }
    button:hover {
      opacity: 0.8;
    }
    #confirmationMessage {
      display: none;
      color: #28a745;
      font-weight: bold;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Volunteer Registration</h2>
    <form id="volunteerForm" method="POST">
      <input type="text" name="name" placeholder="Enter your name" required>
      <input type="text" name="college" placeholder="Enter your college name" required>
      <input type="text" name="standard" placeholder="Enter your standard" required>
      <input type="email" name="email" placeholder="Enter your contact email" required>
      <select name="role" required>
        <option value="">Select Role</option>
        <option value="Video Editor">Video Editor</option>
        <option value="Reel Creator">Reel Creator</option>
        <option value="Instagram Manager">Instagram Manager</option>
        <option value="Product Manager">Product Manager</option>
      </select>
      <button type="submit">Submit</button>
    </form>
    <p id="confirmationMessage"></p>
  </div>

  <?php
  // Database configuration
  $servername = "localhost"; 
  $username = "root"; 
  $password = ""; // Empty password for XAMPP
  $dbname = "data_system"; 










  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
      // Get the form data and sanitize it
      $name = htmlspecialchars($_POST['name']);
      $college = htmlspecialchars($_POST['college']);
      $standard = htmlspecialchars($_POST['standard']);
      $email = htmlspecialchars($_POST['email']);
      $role = htmlspecialchars($_POST['role']);

      // Prepare and bind SQL statement
      $sql = "INSERT INTO users (name, college, standard, email, role) VALUES (?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssss", $name, $college, $standard, $email, $role);

      if ($stmt->execute()) {
          echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                      document.getElementById('confirmationMessage').textContent = 'Thank you, $name. We will update you soon!';
                      document.getElementById('confirmationMessage').style.display = 'block';
                      document.getElementById('volunteerForm').reset();
                  });
                </script>";
      } else {
          echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                      document.getElementById('confirmationMessage').textContent = 'Error: " . htmlspecialchars($stmt->error) . "';
                      document.getElementById('confirmationMessage').style.display = 'block';
                  });
                </script>";
      }

      // Close connections
      $stmt->close();
      $conn->close();
  }
  ?>
</body>
</html>
