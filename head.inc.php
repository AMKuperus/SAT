<head>
  <title>StudentActivityTracker</title>
  <link href="style.css" type="text/css" rel="stylesheet">
  <?php
    $class_name = ['storage', 'activity', 'user', 'student', 'monitor', 'admin'];

    spl_autoload_register(function($class_name) {
      include $class_name . '.class.php';
    });
  ?>
</head>
