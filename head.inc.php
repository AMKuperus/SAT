<head>
  <title>StudentActivityTracker</title>
  <link href="style.css" type="text/css" rel="stylesheet">
  <?php
    require_once 'jumper.inc.php'; include 'functions.inc.php';

    $class_name = ['Storage', 'Activity', 'User', 'Student', 'Monitor', 'Admin'];

    spl_autoload_register(function($class_name) {
      include $class_name . '.class.php';
    });
    echo '<code>Version 0.6 PHP7 Local Test Environment</code>';
  ?>
</head>
