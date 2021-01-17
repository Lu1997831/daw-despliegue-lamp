<?php // Probar la base de datos classics
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['delete']) && isset($_POST['isbn']))
  {
    $isbn   = get_post($conn, 'isbn');
    $query  = "DELETE FROM classics WHERE ISBN='$isbn'";
    $result = $conn->query($query);
  	if (!$result) echo "Error al tratar de borrar: $query<br>" .
      $conn->error . "<br><br>";
  }

  if (isset($_POST['author'])   &&
      isset($_POST['title'])    &&
      isset($_POST['category']) &&
      isset($_POST['year'])     &&
      isset($_POST['isbn']))
  {
    $author   = get_post($conn, 'author');
    $title    = get_post($conn, 'title');
    $category = get_post($conn, 'category');
    $year     = get_post($conn, 'year');
    $isbn     = get_post($conn, 'isbn');
    $query    = "INSERT INTO classics VALUES" .
      "('$author', '$title', '$category', '$year', '$isbn')";
    $result   = $conn->query($query);

  	if (!$result) echo "Error al tratar de insertar: $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  <form action="probar-classics.php" method="post">
  <pre>
    Autor    <input type="text" name="author">
    Título   <input type="text" name="title">
    Categoría     <input type="text" name="category">
    Año      <input type="text" name="year">
    ISBN     <input type="text" name="isbn">
           <input type="submit" value="Agregar Registro">      <input type="reset" value="Limpiar campos">
  </pre></form>
_END;

  $query  = "SELECT * FROM classics";
  $result = $conn->query($query);
  if (!$result) die ("Falló conexión a la base de datos: " . $conn->error);

  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
  <pre>
    Autor      $row[0]
    Título     $row[1]
    Tema       $row[2]
    Año        $row[3]
    ISBN       $row[4]
  </pre>
  <form action="probar-classics.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="isbn" value="$row[4]">
  <input type="submit" value="Borrar Registro"></form>
_END;
  }
  
  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>
