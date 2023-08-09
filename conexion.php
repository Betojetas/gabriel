<?php
$host = 'localhost';
$dbname = 'gabriel';
$username = 'erik_admin';
$pasword = '2002';
$puerto = 1433;


try {
    $cnnPDO = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $pasword);
    // echo "Se conectó correctamen a la base de datos";
} catch (PDOException $exp) {
    echo ("No se logró conectar correctamente con la base de datos: $dbname, error: $exp");
}
return $cnnPDO;
?>