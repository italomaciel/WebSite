<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

/* Vai rodar so se o post for submetido */
if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "message" => $_POST['message'],
      "curtida" => 0,
      "descurtida" => 0
    );

    $sql = sprintf(
      "INSERT INTO users (message,curtida,descurtida) values (:message,:curtida,:descurtida)",
      "users",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote>Post enviado. . .</blockquote>
  <?php endif; ?>

  <h2>Criar Post</h2>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="message">Digite Aqui seu Texto</label>
    <input type="text" name="message" id="message">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
