<?php
// check if the form was submitted
if (isset($_POST['submit'])) {
  // connect to the database
  $db = new PDO('mysql:host=localhost;dbname=app1', 'root', '');

  // prepare the select statement
  $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");

  // bind the form value to the statement
  $stmt->bindValue(':username', $_POST['username']);

  // execute the statement
  $stmt->execute();

  // fetch the user from the database
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // if the user exists and the password is correct
  if ($user !== false && password_verify($_POST['password'], $user['password'])) {
    // log the user in
    $_SESSION['user_id'] = $user['id'];
    header('Location: index.php');
    exit;
  }
}
?>

<!-- form for logging in -->
<form method="post" action="">
  <label for="username">Username</label>
  <input type="text" name="username" required>
  <br>
  <label for="password">Password</label>
  <input type="password" name="password" required>
  <br>
  <input type="submit" name="submit" value="Log In">
</form>
