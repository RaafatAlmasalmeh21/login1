<?php
// check if the form was submitted
if (isset($_POST['submit'])) {
  // connect to the database
  $db = new PDO('mysql:host=localhost;dbname=app1', 'root', '');

  // prepare the insert statement
  $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");

  // bind the form values to the statement
  $stmt->bindValue(':username', $_POST['username']);
  $stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
  $stmt->bindValue(':email', $_POST['email']);

  // execute the insert statement
  $stmt->execute();

  // redirect to login page
  header('Location: login.php');
  exit;
}
?>

<!-- form for creating a new account -->
<form method="post" action="">
  <label for="username">Username</label>
  <input type="text" name="username" required>
  <br>
  <label for="password">Password</label>
  <input type="password" name="password" required>
  <br>
  <label for="email">Email</label>
  <input type="email" name="email" required>
  <br>
  <input type="submit" name="submit" value="Create Account">
</form>
