<?php //fetchrow.php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query  = "SELECT * FROM classics";
  $result = $conn->query($query);
  if (!$result) die($conn->error);

  $rows = $result->num_rows;

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    echo 'Autor: '   . $row['author']   . '<br>';
    echo 'Título: '    . $row['title']    . '<br>';
    echo 'Categoría: ' . $row['category'] . 	'<br>';
    echo 'Año: '     . $row['year']     . '<br>';
    echo 'ISBN: '     . $row['ISBN']     . '<br><br>';
  }

  $result->close();
  $conn->close();
?>
