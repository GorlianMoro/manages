<?php
include 'mysql_connect.php';

$structure = $pdo->prepare('desc peoples');
$structure->execute();

if (isset($_POST['edit']))
{
  if (isset($_POST['oldname']))
  {
    $old = htmlentities($_POST['oldname']);
  }

  if (isset($_POST['newname']))
  {
    $new = htmlentities($_POST['newname']);
  }

  if (isset($_POST['typefield']))
  {
    $type = htmlentities($_POST['typefield']);
  }

  if (!empty($_POST['oldname']))
  {
    if (!empty($_POST['newname']))
     {
      if (!empty($_POST['typefield']))
      {
        $edit = $pdo->exec("alter table peoples change $old $new $type");
        $structure->execute();
      }
    }
  }
}

if (isset($_POST['drop']))
{
  if (isset($_POST['dropfield']))
  {
    $dropfields = htmlentities($_POST['dropfield']);
  }

  if (!empty($_POST['dropfield']))
  {
    $drop = $pdo->exec("alter table peoples drop column $dropfields");
    $structure->execute();
  }
}
 ?>

 <!DOCTYPE html>
  <html lang="ru">
    <head>
      <meta charset="utf-8">
      <title>Table peoples</title>
      <style>
      table {
              border-collapse: collapse;
          }

          table td, table th {
              border: 1px solid black;
            }
    </style>
    </head>
    <body>
      <table>
        <tr>
          <th>Поле</th>
          <th>Тип</th>
        </tr>
        <tr>
          <?php while ($row = $structure->fetch(PDO::FETCH_LAZY))
          { ?>
            <td><?php echo $row['Field'] . "<br />"; ?></td>
            <td><?php echo $row['Type'] . "<br />"; ?></td>
        </tr>
      <?php } ?>
    </table> <br>
      <form class="" action="peoples.php" method="post">
        <input type="text" name="oldname" value="" placeholder="старое имя поля">
        <input type="text" name="newname" value="" placeholder="новое имя поля">
        <input type="text" name="typefield" value="" placeholder="тип поля">
        <input type="submit" name="edit" value="Изменить">
      </form><br>

      <form class="" action="peoples.php" method="post">
        <input type="text" name="dropfield" value="" placeholder="имя поля">
        <input type="submit" name="drop" value="Удалить">
      </form>
    </body>
  </html>
