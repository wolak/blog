<!DOCTYPE html>
<html>
  <head>
    <title>The Awesome Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/assets/css/bootstrap_theme.css" rel="stylesheet" media="screen">
    <link href="/assets/css/main.css" rel="stylesheet" media="screen">

  </head>
  <body>
    <div class="container">
        <h3 class="mainTitle muted">The Awesome Blog!</h3>
        <?php if ($logged_in) echo $navbar; ?>
        <?php echo $content; ?>

    </div> <!-- /container -->

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <?php 
    foreach ($scripts as $script) 
    {
      echo "<script src='$script'></script>";
    }
    ?>
  </body>
</html>