<?php

/**
 * List all users with a link to edit
 */

require "../config.php";
require "../common.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM users";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Update users</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Menssagem</th>
            <th>Curtidas</th>
            <th>Descurtidas</th>
            <th>Data</th>
            <th>Edit</th>
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
            <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>