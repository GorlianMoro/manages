<?php
include 'mysql_connect.php';

$table = $pdo->prepare('show TABLES');
$table->execute();
 ?>

  <!DOCTYPE html>
  <html lang="ru">
    <head>
      <meta charset="utf-8">
      <title>My db</title>
    </head>
    <body>
      <ul>
        <?php while ($row = $table->fetch(PDO::FETCH_LAZY))
        { ?>
        <li> <a href="<?php echo $row['Tables_in_books']; ?>.php"><?php echo $row['Tables_in_books']; ?></a> </li>
      <?php } ?>
      </ul>
    </body>
  </html>
