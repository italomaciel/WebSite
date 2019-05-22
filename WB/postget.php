<?php

    /**
     * Delete a user OR Like the Post
     */

    require "config.php";
    require "common.php";

    $success = null;

    if (isset($_POST["submit"])||isset($_POST["dsubmit"])) {
        if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
      
        if (isset($_POST["submit"])){try {
          $connection = new PDO($dsn, $username, $password, $options);
        
          $id = $_POST["submit"];
      
          $sql = "UPDATE users
                  SET curtida = curtida + 1
                  WHERE id = :id";
      
          $statement = $connection->prepare($sql);
          $statement->bindValue(':id', $id);
          $statement->execute();
      
          $success = "Voce curtiu um post.";
        } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }}
        if (isset($_POST["dsubmit"])){try {
            $connection = new PDO($dsn, $username, $password, $options);
          
            $id = $_POST["dsubmit"];
        
            $sql = "UPDATE users
                    SET descurtida = descurtida + 1
                    WHERE id = :id";
        
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
        
            $success = "Voce descurtiu um post.";
            include "10dlk.php";
          } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
          }}
      }

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $sql = "SELECT * FROM users ORDER BY id DESC";

      $statement = $connection->prepare($sql);
      $statement->execute();

      $result = $statement->fetchAll();
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
    ?>

    <?php if ($success) echo $success; ?>

    <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <table>
        <tbody>
        <?php foreach ($result as $row) : ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-preview">
                        <h4 class="post-title">
                            POST <?php echo escape($row["id"]); ?>
                        </h4>
                        <p></p>
                        <h3 class="post-subtitle">
                            <?php echo escape($row["message"]); ?>
                        </h3>
                        <?php include "ifimg.php"; ?>
                        <p></p>
                        <p class="post-meta"><button type="submit" style="float:right" name="submit" value="<?php echo escape($row["id"]); ?>"><?php echo escape($row["curtida"]); ?> Like</button> 
                        <button type="submit" style="float:right" name="dsubmit" value="<?php echo escape($row["id"]); ?>"><?php echo escape($row["descurtida"]); ?> Dislike</button></p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        </tbody>
      </table>
    </form>