<?php
  include 'mysql_connect.php';

  $table = $pdo->prepare('show TABLES');
  $table->execute();

if (isset($_GET['edit']))
{
  if (isset($_GET['edittab']))
  {
    $edittab = htmlentities($_GET['edittab']);
  }
  if (isset($_GET['oldname']))
  {
    $old = htmlentities($_GET['oldname']);
  }

  if (isset($_GET['newname']))
  {
    $new = htmlentities($_GET['newname']);
  }

  if (isset($_GET['typefield']))
  {
    $type = htmlentities($_GET['typefield']);
  }

  if (!empty($_GET['oldname']))
  {
    if (!empty($_GET['newname']))
    {
      if (!empty($_GET['typefield']))
      {
        $edit = $pdo->exec("alter table $edittab change $old $new $type");

      }
    }
  }
}

if (isset($_GET['drop']))
{
  if (isset($_GET['droptab']))
  {
    $droptab = htmlentities($_GET['droptab']);
  }

  if (isset($_GET['dropfield']))
  {
    $dropfields = htmlentities($_GET['dropfield']);
  }

  if (!empty($_GET['dropfield']))
  {
    $drop = $pdo->exec("alter table $droptab drop column $dropfields");
  }
}
 ?>

 <!DOCTYPE html>
 <html lang="ru">
   <head>
     <meta charset="utf-8">
     <title>Tables</title>
     <style>
        table
        {
          border-collapse: collapse;
        }

        table td, table td
        {
          border: 1px solid black;
        }
   </style>
   </head>
   <body>
     <?php foreach ($table as $row): ?>
     <table>
       <tr>
         <th><?php echo $row['Tables_in_books']; ?></th>
       </tr>
       <tr>
         <td>Поле</td>
         <td>Тип</td>
         <td></td>
         <td></td>
       </tr>
       <?php
       $tab = $row['Tables_in_books'];
       $structure = $pdo->query("desc $tab ");
       foreach ($structure as $struct)
       {
         $fil = $struct['Field'];
         ?>
         <tr>
           <td><?php echo $struct['Field'] . "<br />"; ?></td>
           <td><?php echo $struct['Type'] . "<br />"; ?></td>
           <td>
             <form class="" action="index.php" metdod="get">
               <input type="hidden" name="edittab" value="<?php echo $tab; ?>">
               <input type="hidden" name="oldname" value="<?php echo $fil; ?>">
               <input type="text" name="newname" value="" placeholder="новое имя поля">
               <input type="text" name="typefield" value="" placeholder="тип поля">
               <input type="submit" name="edit" value="Изменить">
             </form>
           </td>
           <td>
             <form class="" action="index.php" metdod="get">
               <input type="hidden" name="droptab" value="<?php echo $tab; ?>">
               <input type="hidden" name="dropfield" value="<?php echo $fil; ?>">
               <input type="submit" name="drop" value="Удалить">
             </form>
           </td>
        <?php } ?>
         </tr>
     </table> <br>
   <?php endforeach; ?>
   </body>
 </html>
