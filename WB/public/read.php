<?php

/**
 * Function to query information based on 
 * a parameter: in this case, message.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * 
            FROM users
            WHERE message = :message";

    $message = $_POST['message'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':message', $message, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
        <tr>
          <th>#ID</th>
          <th>Post</th>
          <th>Likes</th>
          <th>Dislikes</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["message"]); ?></td>
          <td><?php echo escape($row["curtida"]); ?></td>
          <td><?php echo escape($row["descurtida"]); ?></td>
          <td><?php echo escape($row["date"]); ?> </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>Nenhum resultado encontrado para <?php echo escape($_POST['message']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Encontrar Menssagens</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <label for="message">Texto</label>
  <input type="text" id="message" name="message">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>