<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clean Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">Start Bootstrap</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="post.html">Sample Post</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <hr class="small">
                        <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php

    /**
     * Delete a user OR Like the Post
     */

    require "../config.php";
    require "../common.php";

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
          } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
          }}
      }

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
                        <a href="post.html">
                            <h2 class="post-title">
                                Spotted <?php echo escape($row["id"]); ?>
                            </h2>
                            <h3 class="post-subtitle">
                                <?php echo escape($row["message"]); ?>
                            </h3>
                        </a>
                        <p class="post-meta"> <?php echo escape($row["curtida"]); ?>  <button type="submit" name="submit" value="<?php echo escape($row["id"]); ?>">Like</button> 
                            <?php echo escape($row["descurtida"]); ?>  <button type="submit" name="dsubmit" value="<?php echo escape($row["id"]); ?>">Dislike</button></p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        </tbody>
      </table>
    </form>

    <a href="index.php">Back to home</a>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">
                            Spotted <?php echo escape($row["id"]); ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php echo escape($row["message"]); ?>
                        </h3>
                    </a>
                    <p class="post-meta"> <?php echo escape($row["curtida"]); ?>  <button type="submit" name="submit" value="<?php echo escape($row["id"]); ?>">Like</button> 
                        <?php echo escape($row["descurtida"]); ?>  <button type="submit" name="dsubmit" value="<?php echo escape($row["id"]); ?>">Dislike</button></p>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
